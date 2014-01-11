<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:57
 */
class LudoJSParts extends Package implements PackageInterface
{
    public function getRootFolder()
    {
        return "../ludojs-parts/";
    }

    public function getLicenseText()
    {
        return "/**
        LudoJS
        Copyright (C) 2012-[DATE] ludojs.com

        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
         */";
    }

    public function getAllModules()
    {
        return array(

        );
    }

    public function getExternalModuleDependencies()
    {
        return array(
            array("package" => "LudoJS",
                "modules" => array(
                    "grid/Grid"
                )
            )
        );
    }

    public function getCssSkins()
    {
        return array();
    }
}
