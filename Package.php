<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:59
 */

class Package
{
    protected $name;
    private $customModules;


    public function __construct()
    {
        $this->name = get_class($this);
        $this->name = preg_replace("/([A-Z][a-z])/s", "-$1", $this->name);
        $this->name = trim(strtolower($this->name), "-");
    }

    public function getName()
    {
        return $this->name;
    }

    protected function getJSFolder()
    {
        return $this->getRootFolder() . "src/";
    }

    protected function getCSSFolder()
    {
        return $this->getRootFolder() . "css-source/";
    }

    public function getRootFolder(){
        return $this->name;
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
        $folder = $this->getRootFolder() . "js";
        return $folder . "/" . $this->getName() . ".js";
    }

    public function getJSFileNameMinified()
    {
        $folder = $this->getRootFolder() . "js";
        return $folder . "/" . $this->getName() . "-minified.js";
    }


    public function getCSSFileName($skinName = null, $suffix = "")
    {
        if(isset($skinName))$skinName = "-".$skinName;
        $folder = $this->getRootFolder() . "css";
        return $folder . "/" . $this->getName() . $skinName . $suffix . ".css";
    }

    public function getZipFolder(){
        return $this->getRootFolder() . "zip/";
    }

    public function getCSSFileNameMinified()
    {
        $folder = $this->getRootFolder() . "css";
        return $folder . "/" . $this->getName() . "-minified.css";
    }

    private function isNamespace($key)
    {
        return preg_match("/^[a-z\-0-9\/]+$/s", $key);
    }

    private function isModule($key)
    {
        $tokens = explode("/", $key);
        return preg_match("/^[A-Z][a-z].+$/", array_pop($tokens));
    }

    public function getAModule($key)
    {
        $tokens = explode("/", $key);
        $currentModule = $this->getAllModules();
        foreach ($tokens as $token) {
            if (is_array($currentModule) && isset($currentModule['modules']) && is_array($currentModule['modules'])) {
                $currentModule = $currentModule['modules'];
            }
            $currentModule = & $currentModule[$token];
        }

        return $currentModule;
    }

    public function getAllCssFiles()
    {
        return $this->getCSSFor($this->getRootNodes());
    }

    public function getAllJsFiles()
    {
        return $this->getFilesFor($this->getRootNodes());
    }

    private function getRootNodes()
    {
        $ret = array();
        $nodes = $this->getModules();
        foreach ($nodes as $key => $value) {
            $ret[] = is_array($value) ? $key : $value;
        }
        return $ret;
    }

    public function getCssFor($modules = array(), $firstRun = true)
    {
        if (!is_array($modules)) $modules = array($modules);
        $ret = array();

        foreach ($modules as $moduleName) {
            $module = $this->getAModule($moduleName);
            if ($this->isNamespace($moduleName)) {
                $ret = array_merge($ret, $this->getCssFromNode($moduleName, $module));
                $ret = array_merge($ret, $this->getCssFor($this->getModuleKeys($moduleName, $module), false));
            } else if ($this->isModule($moduleName)) {
                if (is_array($module) && isset($module['dependencies'])) {
                    $deps = $this->getDependenciesInRightOrder($module);
                    foreach ($deps as $dependency) {
                        if (!$this->isFile($dependency)) {
                            $ret = array_merge($ret, $this->getCssFor(array($dependency), false));
                        }
                    }
                }
                $ret = array_merge($ret, $this->getCssFromNode($moduleName, $module));
            }
        }
        if ($firstRun) {
            $ret = $this->toCssPaths($ret);
        }
        return $ret;
    }

    private function getCssFromNode($name, $node)
    {
        $ret = array();
        if (is_array($node) && isset($node['css'])) {
            if (is_bool($node['css'])) {
                $node['css'] = $this->getFileName($name) . ".css";
            }
            if (is_string($node['css'])) {
                $ret[] = $this->getFolder($name) . $node['css'];
            } else {
                foreach ($node['css'] as $cssFile) {
                    $ret[] = $this->getFolder($name) . $cssFile;
                }
            }
        }
        return $ret;

    }

    private function getFileName($modulePath)
    {
        $array = explode("/", $modulePath);
        $ret = array_pop($array);
        $ret = preg_replace("/([A-Z])/s", "-$1", $ret);
        $ret = trim($ret, "-");
        return strtolower($ret);
    }

    private function toCssPaths($files)
    {
        $files = array_unique($files);
        foreach ($files as & $file) {
            $file = $this->getCSSFolder() . $file;
        }
        return $files;
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
                    if (is_array($module) && isset($module['dependencies'])) {
                        $deps = $this->getDependenciesInRightOrder($module);
                        foreach ($deps as $dependency) {
                            if ($this->isFile($dependency)) {
                                $ret[] = $dependency;
                            } else {
                                $ret = array_merge($ret, $this->getFilesFor(array($dependency), false));
                            }
                        }
                    }
                    $ret[] = $this->toFileName($moduleName);
                }
            } else {
                $ret[] = $this->toFileName($moduleName);
            }
        }

        if ($firstRun) {
            return $this->jsWithFolderPrefix($ret);
        }
        return $ret;
    }

    private function getDependenciesInRightOrder($module)
    {
        $ret = array();
        foreach ($module['dependencies'] as $dep) {
            if ($this->isFile($dep)) {
                array_push($ret, $dep);
            } else {
                array_unshift($ret, $dep);
            }
        }
        return $ret;
    }

    private function jsWithFolderPrefix($files)
    {
        $files = array_unique($files);
        $prefix = $this->getJSFolder();
        foreach ($files as & $file) {
            $file = $prefix . $file;
        }
        return array_values($files);
    }

    public function getModuleKeys($namespace, $module)
    {
        if (is_string($module)) return array();
        if (is_array($module) && !isset($module['modules'])) {
            $ret = array_keys($module);
        } else {
            $ret = array();
            if(is_string($module['modules'])){
                $module['modules'] = array($module['modules']);
            }
            foreach($module['modules'] as $key=>$value){
                $ret[] = is_array($value) ? $key : $value;
            }

        }
        if (!is_array($ret)) {
            $ret = array($ret);
        }
        foreach ($ret as &$value) {
            $value = $namespace . "/" . $value;
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
            $tokens = explode("/", $item);
            $lastItem = array_pop($tokens);
            if(!$this->isModule($lastItem)){
                $tokens[] = $lastItem;
            }
            return implode("/", $tokens) . "/";
        }
        return $this->isNamespace($item) ? $item."/" : "";
    }

    public function getCssSkinFiles(){
        $skins = $this->getCssSkins();
        $ret = array();
        foreach($skins as $name=>&$file){
            $ret[$name] = $this->getCSSFolder()."skin/". $file;
        }
        return $ret;
    }

    public function getCssSkins(){
        return array();
    }

    private function isFile($item)
    {
        return strstr($item, ".");
    }

    public function getExternalModuleDependencies()
    {
        return array();
    }

    public function getUrlsToRunBeforeStart(){
        return array();
    }
    public function getUrlsToRunAtEnd(){
        return array();
    }
}