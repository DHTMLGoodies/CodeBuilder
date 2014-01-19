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

            "Base" => array("dependencies" => array("external/mootools-core-1.4.5.js","external/jquery.js")),
            "socket.js" => array("dependencies" => array("Base")),
            "socket" => array(
                "modules" => array(
                    'Socket' => array('dependencies' => array(), 'hidden' => true),
                )
            ),
            "model" => array(
                "modules" => array(
                    'Base' => array('dependencies' => array(), 'hidden' => true),
                    'Sudoku' => array('dependencies' => array('model/Base'), 'hidden' => true)
                )
            ),
            "view" => array(
                "modules" => array(
                    'Base' => array('dependencies' => array(), 'hidden' => true),
                    'Sudoku' => array('dependencies' => array('view/Base'), 'hidden' => true, "css" => true)
                ),
                "sketchpad" => array(
                    "modules" => array(
                        "Base" => array("dependencies" => array("view/Base")),
                        "Sudoku" => array("dependencies" => array("view/sketchpad/Base"))

                    )
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