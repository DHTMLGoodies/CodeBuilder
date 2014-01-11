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
            "Base",
            "socket.js" => array("dependencies" => array("Base")),
            "model" => array(
                "modules" => array(
                    'Base' => array('dependencies' => array(), 'hidden' => true),
                    'Sudoku' => array('dependencies' => array('model/Base'), 'hidden' => true)
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