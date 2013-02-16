<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 16.02.13
 * Time: 01:37
 */
require_once(__DIR__."/../autoload.php");

class BuilderTests extends PHPUnit_Framework_TestCase
{
    public function setUp(){
        error_reporting(E_ALL);
    }
    /**
     * @test
     */
    public function shouldFindModulePassedToConstructor(){
        // given
        $builder = new Builder("ludoJS","build");
        // then
        $this->assertEquals('ludoJS', $builder->getPackage());
    }

    /**
     * @test
     */
    public function shouldGetPackageName(){
        // given
        $ludoJs = new LudoJS();
        // then
        $this->assertEquals('LudoJS', $ludoJs->getName());

    }

    /**
     * @test
     */
    public function shouldGetPathToDestinationJSFile(){
        // given
        $ludoJs = new LudoJS();

        // then
        $this->assertEquals('../ludojs/js/ludojs-all.js', $ludoJs->getJSFileName());
    }

    /**
     * @test
     */
    public function shouldBeAbleToGetTopModules(){
        // given
        $ludoJS = new LudoJS();
        // when
        $module = $ludoJS->getAModule('Core');
        // then
        $this->assertNotNull($module);
    }
    /**
     * @test
     */
    public function shouldBeAbleToGetSubModules(){
        // given
        $ludoJS = new LudoJS();
        // when
        $module = $ludoJS->getAModule('remote/JSON');
        // then
        $this->assertNotNull($module);
    }

    /**
     * @test
     */
    public function shouldGetFilesForAModule(){
        // given
        $ludoJs = new LudoJS();

        // when
        $files = $ludoJs->getFilesFor(array('Core'));
        $expected = array('../ludojs/src/ludo.js', '../ludojs/src/effect.js', '../ludojs/src/language/default.js',
            '../ludojs/src/storage/storage.js', '../ludojs/src/object-factory.js', '../ludojs/src/config.js','../ludojs/src/core.js');
        // then

        $this->assertEquals($expected, $files);

    }
    /**
     * @test
     */
    public function shouldGetFilesForANamespace(){
        // given
        $ludoJs = new LudoJS();

        // when
        $files = $ludoJs->getFilesFor(array('tpl'));
        $expected = array('../ludojs/src/tpl/parser.js');
        // then

        $this->assertEquals($expected, $files);

    }

    /**
     * @test
     */
    public function shouldRearrangeFiles(){
        // given
        $ludoJs = new LudoJS();

        // when
        $files = $ludoJs->getFilesFor(array('View', 'Core'));
        $posCore = array_search("core.js", $files);
        $posView = array_search("view.js", $files);

        // then
        $this->assertTrue($posView > $posCore);

    }

    /**
     * @test
     */
    public function shouldGetAllFiles(){
        // given
        $ludoJS = new LudoJS();

        // when
        $files = $ludoJS->getAllJsFiles();


        $this->assertEquals(array('alf'), $files);
    }
}
