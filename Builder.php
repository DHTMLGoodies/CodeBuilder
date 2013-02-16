<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:39
 */
class Builder implements LudoDBService
{
    private $package;

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
        $ret[] = $this->buildCSS();
        $ret[] = $this->buildJS();
        return $ret;

    }

    private function buildJS(){
        $files = $this->package->getAllJsFiles();
        $toFile = $this->package->getJSFileName();
        $fh = fopen($toFile, "w");
        fwrite($fh, $this->getJSfromDependingPackages($this->package));
        fwrite($fh, $this->getFileContent($files));
        fclose($fh);
        return array("file" => $toFile, "size" => filesize($toFile));
    }

    private function buildCSS(){
        $toFile = $this->package->getCSSFileName();
        file_put_contents($toFile, $this->getAllCss($this->package));
        return array("file" => $toFile, "size" => filesize($toFile));

        // getCSSFileName
    }

    private function getAllCss(Package $package){
        $ret = "";

        $files = $package->getAllCssFiles();

        $ret .= $this->getCssFromDependingPackages($package);;
        $ret .= $this->getFileContent($files);;

        return $ret;

    }

    private function getCssFromDependingPackages(Package $object){
        $ret = "";
        $dependencies = $object->getExternalModuleDependencies();
        if(is_array($dependencies)){
            foreach($dependencies as $dep){
                if(!isset($dep['package']) || !isset($dep['modules'])){
                    throw new LudoDBException("Invalid dependency configuration");
                }
                $instance = $this->getPackageClass($dep['package']);
                $files = $instance->getCSSFor($dep['modules']);
                $ret .= $this->getFileContent($files);
            }
        }
        return $ret;
    }

    private function getJSfromDependingPackages(Package $object){
        $ret = "";

        $dependencies = $object->getExternalModuleDependencies();

        if(is_array($dependencies)){

            foreach($dependencies as $dep){
                if(!isset($dep['package']) || !isset($dep['modules'])){
                    throw new LudoDBException("Invalid dependency configuration");
                }
                $instance = $this->getPackageClass($dep['package']);
                $files = $instance->getFilesFor($dep['modules']);
                $ret .= $this->getFileContent($files);
            }
        }

        return $ret;
    }

    private function getFileContent($files){
        $ret = "";
        foreach($files as $file){
            if(!file_exists($file)){
                throw new LudoDBException("File $file not found");
            }
            $ret .= "// $file\n";
            $ret .= file_get_contents($file);
        }
        return $ret;
    }

    /**
     * @param $name
     * @return Package
     */
    private function getPackageClass($name){
        if(!class_exists($name)){
            throw new Exception("$name does not exists");
        }
        return new $name;
    }

    const TMP_PATH = "/tmp";

    public function minify()
    {
        $files = $this->package->getAllJsFiles();

        $js = $this->getJSfromDependingPackages($this->package);
        $js .= $this->getFileContent($files);


        $js = Minify_YUICompressor::minifyJs($js);

        if(!strlen($js)){
            throw new LudoDBException("Minify failed");
        }
        file_put_contents($this->package->getJSFileNameMinified(), $js);

        $this->minifyCss();
    }

    private function minifyCss(){
        $css = $this->getAllCss($this->package);
        $css = Minify_YUICompressor::minifyCss($css);

        if(!strlen($css)){
            throw new LudoDBException("Minify failed");
        }
        file_put_contents($this->package->getCSSFileNameMinified(), $css);

    }

    public function cacheEnabledFor($service)
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
