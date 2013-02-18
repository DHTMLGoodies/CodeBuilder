<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:39
 */
class Builder implements LudoDBService
{
    /**
     * @var Package|PackageInterface
     */
    private $package;
    private $minifySkin = false;

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


    public function getPackage()
    {
        return $this->package;
    }

    public function build()
    {
        $ret = array();
        $ret["css"] = $this->buildCSS();
        $ret["js"] = $this->buildJS();

        if(!$this->minifySkin){
            $this->insertLicenseMessages($ret['css']);
            $this->insertLicenseMessages($ret['js']);

            if(LudoDB::hasConnection()){
                $this->logFileSizes($ret['css']);
                $this->logFileSizes($ret['js']);
            }
        }

        return $ret;

    }

    public function minify()
    {
        $this->minifySkin = true;

        $ret = $this->build();

        $ret["js"][] = $this->minifyJS();
        $ret['css'][] = $this->minifyCss();

        $this->insertLicenseMessages($ret['css']);
        $this->insertLicenseMessages($ret['js']);

        if(LudoDB::hasConnection()){
            $this->logFileSizes($ret['css']);
            $this->logFileSizes($ret['js']);
        }
        return $ret;
    }

    private function logFileSizes($files)
    {

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
        $lt = str_replace("[DATE]", date("Y"), $lt);
        $lt = "/* Generated ". date("D M j G:i:s T Y") . " */\n". $lt;
        $lt = preg_replace("/\n\s+/s", "\n", $lt);
        $content = $lt . "\n" . $content;
        $content =  str_replace("\n", "\r\n", $content);
        file_put_contents($file, $content);
    }

    private function buildCSS()
    {
        $toFile = $this->package->getCSSFileName();
        $css = $this->getAllCss($this->package);
        file_put_contents($toFile, $css);

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
        $css = Minify_YUICompressor::minifyCss($css);
        $skins = $package->getCssSkinFiles();
        foreach ($skins as $name => $file) {
            $fn = $this->package->getCSSFileName($name);
            $content = file_get_contents($file);
            if ($package->getName() !== $this->package->getName()) {
                $content = $this->copyImageFiles($content, $package);
            }
            if ($this->minifySkin) $content = Minify_YUICompressor::minifyCss($content);
            file_put_contents($fn, $css . $content);
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

        $tokens = explode("/", $to);
        $current = "";
        array_pop($tokens);
        foreach ($tokens as $token) {
            $current .= $token . "/";
            if (!file_exists($current)) {
                mkdir($current, 0775);
            }
        }
        if (!is_dir($to) && !is_dir($from)) {
            if (!copy($from, $to)) {
                throw new Exception("Copy of $from to $to failed");
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


        $js = Minify_YUICompressor::minifyJs($js);

        if (!strlen($js)) {
            throw new LudoDBException("Minify failed");
        }
        $fn = $this->package->getJSFileNameMinified();
        file_put_contents($fn, $js);

        return array('file' => $fn, 'size' => filesize($fn));

    }

    private function minifyCss()
    {
        $css = $this->getAllCss($this->package);
        $css = Minify_YUICompressor::minifyCss($css);

        if (!strlen($css)) {
            throw new LudoDBException("Minify failed");
        }
        $fn = $this->package->getCSSFileNameMinified();
        file_put_contents($fn, $css);
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
