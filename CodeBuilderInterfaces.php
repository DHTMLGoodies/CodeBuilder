<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 02:02
 */

interface PackageInterface{

    public function getRootFolder();

    public function getAllModules();

    public function getLicenseText();

    public function getExternalModuleDependencies();

}