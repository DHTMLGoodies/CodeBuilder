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
            $this->package = $this->arguments[0];
        }
    }


    public function getPackage()
    {
        return $this->package;
    }

    public function build()
    {
        $package = $this->getPackageClass($this->package);
        $files = $package->getAllJsFiles();

        $toFile = $package->getJSFileName();
        $fh = fopen($toFile, "w");
        foreach($files as $file){
            if(!file_exists($file)){
                throw new LudoDBException("File $file not found");
            }
            fwrite($fh, "// $file\n");
            fwrite($fh, file_get_contents($file));


        }
        fclose($fh);
        return $toFile. ", ".filesize($toFile);
    }

    /**
     * @param $name
     * @return Package
     */
    private function getPackageClass($name){
        return new $this->package;
    }

    public function minify()
    {

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
