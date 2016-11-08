<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:39
 */


require_once "autoload.php";

class Builder implements LudoDBService
{
    const TAR_COMMAND = "tar";

    /**
     * @var Package|PackageInterface
     */
    private $package;
    private $minifySkin = false;
    private static $logToDb = true;

    private $fullVersion;

    public function __construct()
    {
        if (func_num_args() > 0) {
            $this->arguments = func_get_args();
            $this->package = $this->getPackageClass($this->arguments[0]);
        }

        require_once 'YUICompressor.php';
        Minify_YUICompressor::$jarFile = dirname(__FILE__) . '/minify/yuicompressor-2.4.7/build/yuicompressor-2.4.7.jar';
        Minify_YUICompressor::$tempDir = self::TMP_PATH;
    }




    public static function disableDB(){
         self::$logToDb = false;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function build()
    {
        $ret = array();

        $ret["build"] = $this->getFullVersion();
        $ret["css"] = $this->buildCSS();
        $ret["js"] = $this->buildJS();

        if (!$this->minifySkin) {
            $this->insertLicenseMessages($ret['css']);
            $this->insertLicenseMessages($ret['js']);

            if (self::$logToDb && LudoDB::hasConnection()) {
                $this->logFileSizes($ret['css']);
                $this->logFileSizes($ret['js']);
            }
        }

        $ret["zip"] = $this->buildZip();

        return $ret;

    }


    public function getFullVersion(){

        if(!isset($this->fullVersion)){
            $versionFile = "build/". $this->package->getName() .".buildno";

            $currentVersion = $this->package->getVersion();

            if(file_exists($versionFile)){
                $versionNo = file_get_contents($versionFile);



                if($this->isSameVersion($versionNo, $currentVersion)){
                    $this->fullVersion = $this->incrementBuildNumber($versionNo);
                    file_put_contents($versionFile, $this->fullVersion );
                }else{
                    $buildNo = 1;
                    $this->fullVersion =  $currentVersion . ".". $buildNo;
                    file_put_contents($versionFile, $this->fullVersion);
                }
            }else{
                $buildNo = 1;
                $this->fullVersion =  $currentVersion . ".". $buildNo;
                file_put_contents($versionFile, $this->fullVersion);
            }
        }

        return $this->fullVersion;

    }

    private function incrementBuildNumber($version){
        $tokens = explode(".", $version);
        $tokens[count($tokens)-1]++;
        return implode(".", $tokens);
    }

    private function isSameVersion($version1, $version2){
        $tokens1 = explode(".", $version1);
        $tokens2 = explode(".", $version2);

        $len = min(count($tokens1), count($tokens2));

        for($i=0;$i<$len;$i++){
            if($tokens1[$i] != $tokens2[$i])return false;
        }
        return true;
    }


    public function minify()
    {
        $this->minifySkin = true;

        $ret = $this->build();

        $ret["js"][] = $this->minifyJS();
        $ret['css'][] = $this->minifyCss();

        $this->insertLicenseMessages($ret['css']);
        $this->insertLicenseMessages($ret['js']);

        if (self::$logToDb && LudoDB::hasConnection()) {
            $this->logFileSizes($ret['css']);
            $this->logFileSizes($ret['js']);
        }
        return $ret;
    }

    private function logFileSizes($files)
    {
        if (!LudoDB::hasConnection()) return;
        foreach ($files as $entry) {
            $obj = new CodeBuilderLog();
            $filename = array_pop(explode("/", $entry['file']));
            $obj->setFileName($filename);
            $obj->setSize($entry['size']);
            $obj->commit();
        }

    }


    private function buildJS()
    {
        $files = $this->package->getAllJsFiles();
        $toFile = $this->package->getJSFileName();
        $this->createFolders($toFile);
        $fh = fopen($toFile, "w");
        fwrite($fh, $this->getJSFromDependingPackages($this->package));
        fwrite($fh, $this->getFileContent($files));
        fclose($fh);
        return array(
            array("file" => $toFile, "size" => filesize($toFile))
        );
    }

    private function insertLicenseMessages($files)
    {
        foreach ($files as $entry) {
            $this->insertLicenseMessage($entry['file']);
        }
    }

    private function insertLicenseMessage($file)
    {
        $content = file_get_contents($file);
        $lt = $this->package->getLicenseText();
        $lt = str_replace("[VERSION]", $this->getFullVersion(), $lt);
        $lt = str_replace("[DATE]", date("Y"), $lt);
        $lt = "/* Generated " . date("D M j G:i:s T Y") . " */\n" . $lt;
        $lt = preg_replace("/\n\s+/s", "\n", $lt);
        $content = $lt . "\n" . $content;

        file_put_contents($file, $content);
    }

    private function buildCSS()
    {
        $toFile = $this->package->getCSSFileName();
        $css = $this->getAllCss($this->package);

        $this->writeToFile($toFile, $css);

        $ret = $this->buildSkinCss($this->package, $css);
        $dependencies = $this->getDependingPackages();
        foreach ($dependencies as $package) {
            $ret = array_merge($ret, $this->buildSkinCss($package, $css));
        }
        $ret[] = array("file" => $toFile, "size" => filesize($toFile));
        return $ret;
    }

    private function buildSkinCss(Package $package, $css = null)
    {
        $ret = array();
        if (!isset($css)) $css = $this->getAllCss($this->package);
        $fullCss = $css;
        $css = Minify_YUICompressor::minifyCss($css);
        $skins = $package->getCssSkinFiles();
        foreach ($skins as $name => $file) {
            $fn = $this->package->getCSSFileName($name);
            $content = file_get_contents($file);
            if ($package->getName() !== $this->package->getName()) {
                $content = $this->copyImageFiles($content, $package);
            }
            if ($this->minifySkin) {
                $this->writeToFile($this->package->getCSSFileName($name, "-readable"), $fullCss . $content);
                $content = Minify_YUICompressor::minifyCss($content);
            }

            $this->writeToFile($fn, $css . $content);

            $ret[] = array("file" => $fn, "size" => filesize($fn));
        }
        return $ret;

    }

    private function copyImageFiles($css, Package $package)
    {
        preg_match_all("/url\(([^\)]+?)\)/si", $css, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $file = $match[1];
            $file = preg_replace("/[^0-9\-a-z\._\/]/si", "", $file);
            $localPath = str_replace("../images", "../" . $this->package->getName() . "/" . $package->getName() . "/images", $file);
            $remotePath = str_replace("../images", "../" . $package->getName() . "/images", $file);
            $replacePath = str_replace("../images", "../" . $package->getName() . "/images", $file);
            if (strstr($file, ".")) {
                if (file_exists($remotePath)) {
                    $this->copyImageFile($remotePath, $localPath);
                }
                $css = str_replace($file, $replacePath, $css);
            }
        }
        return $css;

    }

    private function copyImageFile($from, $to)
    {
        $this->createFolders($to);
        if (!is_dir($to) && !is_dir($from)) {
            if (!copy($from, $to)) {
                throw new Exception("Copy of $from to $to failed");
            }
        }
    }

    private $zipPath;


    private function buildZip(){
        $zipPath = $this->getZipPath();

        $files = $this->package->getFilesForZip();

        $this->setWorkingDirectory();

        foreach($files as $file){
            $cmd = $this->getTarCommand($zipPath, $file);
            exec($cmd);
        }

        $this->restoreWorkingDirectory();


        return array(
            "zip" => $zipPath,
            "zip-size" => filesize($zipPath)
        );

    }

    private $pwd;

    private function setWorkingDirectory(){
        $this->pwd = getcwd();
        chdir($this->package->getRootFolder());
    }

    private function restoreWorkingDirectory(){
        chdir($this->pwd);
    }






    private function getTarCommand($archivePath, $fileToAdd)
    {
        return self::TAR_COMMAND . " -rf " . $archivePath . " " . $fileToAdd;
    }


    private function getZipPath(){
        if(!isset($this->zipPath)){
            $this->zipPath = $this->package->getZipFolder() . $this->package->getName() . "-". $this->getFullVersion() . ".zip";
        }
        return $this->zipPath;
    }

    private function writeToFile($path, $content)
    {
        file_put_contents($path, $content);
    }

    private function createFolders($pathToFile)
    {
        $tokens = explode("/", $pathToFile);
        $current = "";
        array_pop($tokens);
        foreach ($tokens as $token) {
            $current .= $token . "/";
            if (!file_exists($current)) {
                $success = mkdir($current, 0775);
                if(!$success)die("ERROR: Unable to create directory ". $current);
            }
        }
    }

    private function getDependingPackages()
    {
        $dependencies = $this->package->getExternalModuleDependencies();
        $ret = array();
        if (is_array($dependencies)) {
            foreach ($dependencies as $dep) {
                if (!isset($dep['package']) || !isset($dep['modules'])) {
                    throw new LudoDBException("Invalid dependency configuration");
                }
                $instance = $this->getPackageClass($dep['package']);
                $ret[] = $instance;
            }
        }
        return $ret;

    }

    private function getAllCss(Package $package)
    {
        $ret = "";

        $files = $package->getAllCssFiles();

        $ret .= $this->getCssFromDependingPackages($package);
        $ret .= $this->getFileContent($files);


        return $ret;
    }

    private function getCssFromDependingPackages(Package $object)
    {
        $ret = "";
        $dependencies = $object->getExternalModuleDependencies();
        if (is_array($dependencies)) {
            foreach ($dependencies as $dep) {
                if (!isset($dep['package']) || !isset($dep['modules'])) {
                    throw new LudoDBException("Invalid dependency configuration");
                }
                $instance = $this->getPackageClass($dep['package']);
                $files = $instance->getCSSFor($dep['modules']);
                $content = $this->getFileContent($files);

                $ret .= $this->copyImageFiles($content, $instance);
            }
        }

        return $ret;
    }

    private function getJSFromDependingPackages(Package $object)
    {
        $ret = "";

        $dependencies = $object->getExternalModuleDependencies();

        if (is_array($dependencies)) {

            foreach ($dependencies as $dep) {
                if (!isset($dep['package']) || !isset($dep['modules'])) {
                    throw new LudoDBException("Invalid dependency configuration");
                }
                $instance = $this->getPackageClass($dep['package']);
                $files = $instance->getFilesFor($dep['modules']);
                $ret .= $this->getFileContent($files);
            }
        }

        return $ret;
    }

    private function getFileContent($files)
    {
        $ret = "";
        foreach ($files as $file) {
            if (!file_exists($file)) {
                throw new LudoDBException("File $file not found");
            }
            $ret .= "/* $file */\n";
            $ret .= file_get_contents($file);
        }
        return $ret;

    }

    /**
     * @param $name
     * @return Package
     * @throws Exception
     */
    private function getPackageClass($name)
    {
        if (!class_exists($name)) {
            throw new Exception("$name does not exists");
        }
        return new $name;
    }

    const TMP_PATH = "/tmp";


    private function minifyJS()
    {
        $files = $this->package->getAllJsFiles();

        $js = $this->getJSFromDependingPackages($this->package);
        $js .= $this->getFileContent($files);
        $fn = $this->package->getJSFileNameMinified();

        $minifiedJs = Minify_YUICompressor::minifyJs(trim($js));

        error_reporting(E_ALL);
        if (!strlen($minifiedJs)) {
            throw new LudoDBException("Minify failed " . $fn . "(" . strlen($js) . ")");
        }


        $this->writeToFile($fn, $minifiedJs);

        return array('file' => $fn, 'size' => filesize($fn));

    }

    private function minifyCss()
    {
        $css = $this->getAllCss($this->package);

        $fn = $this->package->getCSSFileNameMinified();

        if ($css) {
            $css = Minify_YUICompressor::minifyCss($css);

            if (!strlen($css)) {
                throw new LudoDBException("Minify failed " . $fn);
            }
        }

        $this->writeToFile($fn, $css);
        return array('file' => $fn, 'size' => filesize($fn));

    }

    public function shouldCache($service)
    {
        return false;
    }

    public function getOnSuccessMessageFor($service)
    {
        return "Code build complete";
    }

    public function getValidServices()
    {
        return array('build', 'minify');
    }

    public function validateServiceData($service, $data)
    {
        return true;
    }

    public function validateArguments($service, $arguments)
    {
        if (count($arguments) > 1) return false;
        $package = $arguments[0];
        if (!class_exists($package)) {
            throw new LudoDBException("Class " . $package . " does not exists");
        }
        $r = new ReflectionClass($package);
        if (!$r->implementsInterface("PackageInterface")) {
            throw new LudoDBException("Class " . $package . " is not implementing the PackageInterface");
        }
        if (!$r->isSubclassOf("Package")) {
            throw new LudoDBException("Class " . $package . " is not a sub class of Package");
        }

        return true;
    }
}
