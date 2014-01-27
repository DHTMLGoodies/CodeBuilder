<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class PuzzleAll extends Package implements PackageInterface
{
    public function getRootFolder()
    {
        return "../puzzleall/www/";
    }

    public function getLicenseText()
    {
        return "/**
        Copyright (C) 2014-[DATE] puzzleall.com
         */";
    }

    public function getAllModules()
    {
        return array(
            "Base" => array("dependencies" => array("external/mootools-core-1.4.5.js", "external/jquery.js")),
            "ConfigTemplate" => array("dependencies" => array("Base")),
            "events"=>array(
                "modules" =>array("Events")
            ),
            "socket" => array(
                "modules" => array(
                    'Socket' => array('dependencies' => array(), 'hidden' => true),
                )
            ),
            "storage" => array(
                "modules" => array(
                    'Storage' => array('dependencies' => array("Base"), 'hidden' => true),
                )
            ),
            "model" => array(
                "modules" => array(
                    'Base' => array('dependencies' => array("Base", "events/Events"), 'hidden' => true),
                    'Sudoku' => array('dependencies' => array('model/Base'), 'hidden' => true)
                )
            ),
            "view" => array(
                "modules" => array(
                    'Base' => array('dependencies' => array("Base"), 'hidden' => true),
                    'Sudoku' => array('dependencies' => array('view/Base'), 'hidden' => true, "css" => true),
                    "Notes" => array("dependencies" => array("view/Base"), "css"=> true)
                )
            )
        );
    }

    public function getExternalModuleDependencies()
    {
        return null;
    }

    public function getCssSkins()
    {
        return array();
    }
}