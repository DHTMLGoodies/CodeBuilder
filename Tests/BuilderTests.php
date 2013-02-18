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
        $this->assertInstanceOf('ludoJS', $builder->getPackage());
    }

    /**
     * @test
     */
    public function shouldGetPackageName(){
        // given
        $ludoJs = new LudoJS();
        // then
        $this->assertEquals('ludojs', $ludoJs->getName());

    }

    /**
     * @test
     */
    public function shouldGetPathToDestinationJSFile(){
        // given
        $ludoJs = new LudoJS();

        // then
        $this->assertEquals('../ludojs/js/ludojs.js', $ludoJs->getJSFileName());
    }

    /**
     * @test
     */
    public function shouldGetLudoAsFirstFile(){
        $d = new LudoJS();

        $files = $d->getFilesFor(array(
            "layout", "View","Application", "grid","dialog","form/Password", "form/Email", "form/Number",
            "form/Checkbox", "controller","model","menu","Panel","canvas","remote",
            "form/SubmitButton","form/CancelButton","form/ResetButton", "tree","card",
            "layout","form/ComboTree"
        ));

        $this->assertEquals('../ludojs/src/ludo.js', $files[0]);
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
            '../ludojs/src/storage/storage.js', '../ludojs/src/object-factory.js', '../ludojs/src/config.js',
            '../ludojs/src/assets.js','../ludojs/src/core.js');
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
        $posCore = array_search("../ludojs/src/core.js", $files);
        $posView = array_search("../ludojs/src/view.js", $files);

        // then
        $this->assertLessThan($posView, $posCore);

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

        $this->assertEquals("../ludojs/src/ludo.js", $files[0]);
        $this->assertTrue(in_array("../ludojs/src/canvas/element.js", $files));
        $this->assertTrue(in_array("../ludojs/src/view.js", $files));
        $this->assertTrue(in_array("../ludojs/src/form/validator/md5.js", $files), "md5 validator file missing");
    }

    /**
     * @test
     */
    public function shouldGetCssFiles(){
        // given
        $ludoJS = new LudoJS();

        // when
        $cssFiles = $ludoJS->getCssFor("View");

        // then
        $this->assertEquals(array("../ludojs/css-source/view.css", "../ludojs/css-source/resize.css"), $cssFiles);
    }
    /**
     * @test
     */
    public function shouldGetCssFilesForDepending(){
        // given
        $ludoJS = new LudoJS();

        // when
        $cssFiles = $ludoJS->getCssFor("FramedView");
        // then
        $this->assertEquals(array("../ludojs/css-source/view.css", "../ludojs/css-source/resize.css"), $cssFiles);


        // given
        $ludoJS = new LudoJS();

        // when
        $expected = array(
            "../ludojs/css-source/view.css",
            "../ludojs/css-source/resize.css",
            "../ludojs/css-source/form/form.css",
            "../ludojs/css-source/form/text.css"
        );
        $cssFiles = $ludoJS->getCssFor('form/Text');

        // then
        $this->assertEquals($expected, $cssFiles);

    }

    /**
     * @test
     */
    public function shouldGetCssFilesInsideANamespace(){
        // given
        $ludoJS = new LudoJS();

        // when
        $cssFiles = $ludoJS->getCssFor("grid");
        // then
        $this->assertEquals(array("../ludojs/css-source/view.css",
                "../ludojs/css-source/resize.css",
                "../ludojs/css-source/grid/grid.css"), $cssFiles);
    }

    /**
     * @test
     */
    public function shouldGetNameOfModulesInABranch(){
        // given
        $obj = new LudoJS();
        $expected = array("/NewGame", "/OverwriteMove", "/Promote","/Comment", "/GameImport");
        $names = $obj->getModuleKeys("", array(
            "modules" => array(
                "NewGame", "OverwriteMove", "Promote" => array("css" => true), "Comment", "GameImport"
            )
        ));
        $this->assertEquals($expected, $names);

    }
}
