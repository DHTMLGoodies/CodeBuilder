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
        return "../puzzleallweb/";
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
            "services"=>array(
                "modules" =>array("Services")
            ),
            "socket" => array(
                "modules" => array(
                    'Socket' => array('dependencies' => array(), 'hidden' => true),
                    'Request' => array('dependencies' => array("Base"), 'hidden' => true),
                )
            ),
            "storage" => array(
                "modules" => array(
                    'Storage' => array('dependencies' => array("Base"), 'hidden' => true),
                )
            ),
            "action" => array(
                "modules" => array(
                    'Action' => array('dependencies' => array(), 'hidden' => true),
                )
            ),
            "factory" => array(
                "modules" => array(
                    'Factory' => array('dependencies' => array(), 'hidden' => true),
                )
            ),
            "model" => array(
                "modules" => array(
                    'SudokuKakuroBase' => array('dependencies' => array("Base", "services/Services"), 'hidden' => true),
                    'Sudoku' => array('dependencies' => array('model/SudokuKakuroBase'), 'hidden' => true),
                    'User' => array('dependencies' => array("services/Services"), 'hidden' => true)
                )
            ),
            "view" => array(
                "modules" => array(
                    'Viewport' => array('dependencies' => array("Base"), 'hidden' => true, "css" => true),
                    'Base' => array('dependencies' => array("Base"), 'hidden' => true),
                    'SudokuKakuroBase' => array('dependencies' => array("View/Base"), 'hidden' => true),
                    'Sudoku' => array('dependencies' => array('view/SudokuKakuroBase'), 'hidden' => true, "css" => true),
                    "Notes" => array("dependencies" => array("view/SudokuKakuroBase"), "css"=> true)
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