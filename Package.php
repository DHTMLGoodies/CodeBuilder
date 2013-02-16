<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:59
 */

class Package
{
    private $name;
    private $customModules;

    public function __construct()
    {
        $this->name = get_class($this);
    }

    public function getName()
    {
        return $this->name;
    }

    protected function getJSFolder()
    {
        return "src/";
    }

    protected function getCSSFolder()
    {
        return "css/";
    }

    public function setCustomModules($modules)
    {
        $this->customModules = $modules;
    }

    public function getModules()
    {
        return isset($this->customModules) ? $this->customModules : $this->getAllModules();
    }

    protected function getAllModules()
    {
        return array();
    }

    public function getJSFileName()
    {
        $folder = implode("/", array($this->getRootFolder() . "js"));
        return $folder . "/" . strtolower($this->getName()) . "-all.js";
    }

    private function isNamespace($key)
    {
        return preg_match("/^[a-z\-]+$/s", $key);
    }

    public function getAModule($key)
    {
        $tokens = explode("/", $key);
        $currentModule = $this->getAllModules();
        foreach ($tokens as $token) {
            if (isset($currentModule['modules']) && is_array($currentModule['modules'])) {
                $currentModule = $currentModule['modules'];
            }
            $currentModule = & $currentModule[$token];
        }

        return $currentModule;
    }

    public function getAllJsFiles()
    {
        return $this->getFilesFor(array_keys($this->getModules()));
    }

    public function getFilesFor(array $modules, $firstRun = true)
    {
        $ret = array();
        foreach ($modules as $moduleName) {
            $module = $this->getAModule($moduleName);
            if (isset($module)) {
                if ($this->isNamespace($moduleName)) {
                    $ret = array_merge($ret, $this->getFilesFor($this->getModuleKeys($moduleName, $module), false));
                } else {
                    if (isset($module['dependencies'])) {
                        foreach ($module['dependencies'] as $dependency) {
                            if ($this->isFile($dependency)) {
                                $ret[] = $dependency;
                            } else {
                                $ret = array_merge($ret, $this->getFilesFor(array($dependency), false));
                            }
                        }
                    }
                    $ret[] = $this->toFileName($moduleName);
                }
            }
        }
        if($firstRun){
            return $this->jsWithFolderPrefix($ret);

        }
        return $ret;
    }

    private function jsWithFolderPrefix($files){
        $files = array_unique($files);
        $prefix = $this->getRootFolder().$this->getJSFolder();
        foreach($files as & $file){
            $file = $prefix.$file;
        }

        return array_values($files);
    }

    private function getModuleKeys($namespace, $module){
        $ret = array_keys($module['modules']);
        foreach($ret as &$value){
            $value = $namespace."/".$value;
        }
        return $ret;
    }

    private function toFileName($item)
    {
        if ($this->isFile($item)) {
            return $item;
        }
        $ret = strtolower(preg_replace("/([A-Z][a-z])/s", "-$1$2", $item));
        $ret = str_replace("/-", "/", $ret);
        return ltrim($ret, "-") . ".js";
    }

    private function getFolder($item)
    {
        if (strstr($item, "/")) {
            return array_shift(explode("/", $item)) . "/";
        }
        return "";
    }

    private function isFile($item)
    {
        return strstr($item, ".");
    }
}