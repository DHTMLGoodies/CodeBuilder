<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit

spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'accessortest' => '/ludoDB/Tests/AccessorTest.php',
                'achild' => '/ludoDB/Tests/classes/Dependencies/AChild.php',
                'acity' => '/ludoDB/Tests/classes/Dependencies/ACity.php',
                'allcarproperties' => '/ludoDB/Tests/classes/AllCarProperties.php',
                'anotherchild' => '/ludoDB/Tests/classes/Dependencies/AnotherChild.php',
                'aparent' => '/ludoDB/Tests/classes/Dependencies/AParent.php',
                'asibling' => '/ludoDB/Tests/classes/Dependencies/ASibling.php',
                'author' => '/ludoDB/examples/mod_rewrite/Author.php',
                'availableservicestest' => '/ludoDB/Tests/AvailableServicesTest.php',
                'book' => '/ludoDB/examples/mod_rewrite/Book.php',
                'bookauthor' => '/ludoDB/examples/mod_rewrite/BookAuthor.php',
                'bookauthors' => '/ludoDB/examples/mod_rewrite/BookAuthors.php',
                'brand' => '/ludoDB/Tests/classes/Brand.php',
                'builder' => '/Builder.php',
                'buildertests' => '/Tests/BuilderTests.php',
                'cachetest' => '/ludoDB/Tests/CacheTest.php',
                'capital' => '/ludoDB/Tests/classes/JSONCaching/Capital.php',
                'capitals' => '/ludoDB/Tests/classes/JSONCaching/Capitals.php',
                'car' => '/ludoDB/Tests/classes/Car.php',
                'carcollection' => '/ludoDB/Tests/classes/CarCollection.php',
                'carproperties' => '/ludoDB/Tests/classes/CarProperties.php',
                'carproperty' => '/ludoDB/Tests/classes/CarProperty.php',
                'carswithproperties' => '/ludoDB/Tests/classes/CarsWithProperties.php',
                'city' => '/ludoDB/Tests/classes/City.php',
                'client' => '/ludoDB/Tests/classes/Client.php',
                'codebuilderlog' => '/CodeBuilderLog.php',
                'codebuildertests' => '/Tests/CodeBuilderTests.php',
                'collectiontest' => '/ludoDB/Tests/CollectionTest.php',
                'columnaliastest' => '/ludoDB/Tests/ColumnAliasTest.php',
                'configparsertest' => '/ludoDB/Tests/ConfigParserTest.php',
                'configparsertestjson' => '/ludoDB/Tests/ConfigParserTestJSON.php',
                'democities' => '/ludoDB/examples/cities/DemoCities.php',
                'democity' => '/ludoDB/examples/cities/DemoCity.php',
                'democountries' => '/ludoDB/examples/cities/DemoCountries.php',
                'democountry' => '/ludoDB/examples/cities/DemoCountry.php',
                'demostate' => '/ludoDB/examples/cities/DemoState.php',
                'demostates' => '/ludoDB/examples/cities/DemoStates.php',
                'dhtmlchess' => '/DHTMLChess.php',
                'dhtmlchessmaster' => '/DhtmlchessMaster.php',
                'dhtmlchesswordpress' => '/DHTMLChessWordpress.php',
                'dhtmlchesswordpressfree' => '/DHTMLChessWordpressFree.php',
                'firephp' => '/minify/min/lib/FirePHP.php',
                'forsqltest' => '/ludoDB/Tests/classes/ForSQLTest.php',
                'grandparent' => '/ludoDB/Tests/classes/Dependencies/GrandParent.php',
                'http_conditionalget' => '/minify/min/lib/HTTP/ConditionalGet.php',
                'http_encoder' => '/minify/min/lib/HTTP/Encoder.php',
                'jscompilercontext' => '/minify/min/lib/JSMinPlus.php',
                'jsmin' => '/minify/min/lib/JSMin.php',
                'jsmin_unterminatedcommentexception' => '/minify/min/lib/JSMin.php',
                'jsmin_unterminatedregexpexception' => '/minify/min/lib/JSMin.php',
                'jsmin_unterminatedstringexception' => '/minify/min/lib/JSMin.php',
                'jsminplus' => '/minify/min/lib/JSMinPlus.php',
                'jsnode' => '/minify/min/lib/JSMinPlus.php',
                'jsontest' => '/ludoDB/Tests/JSONTest.php',
                'jsparser' => '/minify/min/lib/JSMinPlus.php',
                'jstoken' => '/minify/min/lib/JSMinPlus.php',
                'jstokenizer' => '/minify/min/lib/JSMinPlus.php',
                'leafnode' => '/ludoDB/Tests/classes/LeafNode.php',
                'leafnodes' => '/ludoDB/Tests/classes/LeafNodes.php',
                'ludodb' => '/ludoDB/LudoDB.php',
                'ludodbadapter' => '/ludoDB/LudoDBInterfaces.php',
                'ludodbadaptertest' => '/ludoDB/Tests/LudoDBAdapterTest.php',
                'ludodballtests' => '/ludoDB/Tests/LudoDBAllTests.php',
                'ludodbcache' => '/ludoDB/LudoDBCache.php',
                'ludodbclassnotfoundexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbcollection' => '/ludoDB/LudoDBCollection.php',
                'ludodbcollectionconfigparser' => '/ludoDB/LudoDBCollectionConfigParser.php',
                'ludodbconfigparser' => '/ludoDB/LudoDBConfigParser.php',
                'ludodbvalidator' => '/ludoDB/LudoDBValidator.php',
                'ludodbconnectionexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbinvalidargumentsexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbinvalidconfigexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbinvalidserviceexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbiterator' => '/ludoDB/LudoDBIterator.php',
                'ludodbmodel' => '/ludoDB/LudoDBModel.php',
                'ludodbmodeltests' => '/ludoDB/Tests/LudoDBModelTests.php',
                'ludodbmysql' => '/ludoDB/LudoDBMysql.php',
                'ludodbmysqli' => '/ludoDB/LudoDBMySqlI.php',
                'ludodbobject' => '/ludoDB/LudoDBObject.php',
                'ludodbobjectnotfoundexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbpdo' => '/ludoDB/LudoDBPDO.php',
                'ludodbregistry' => '/ludoDB/LudoDBRegistry.php',
                'ludodbrequesthandler' => '/ludoDB/LudoDBRequestHandler.php',
                'ludodbservice' => '/ludoDB/LudoDBInterfaces.php',
                'ludodbservicenotimplementedexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbserviceregistry' => '/ludoDB/LudoDBServiceRegistry.php',
                'ludodbsql' => '/ludoDB/LudoDBSQL.php',
                'ludodbtreecollection' => '/ludoDB/LudoDBTreeCollection.php',
                'ludodbtreecollectiontest' => '/ludoDB/Tests/LudoDBTreeCollectionTest.php',
                'ludodbunauthorizedexception' => '/ludoDB/LudoDBExceptions.php',
                'ludodbutility' => '/ludoDB/LudoDBUtility.php',
                'ludodbutilitymock' => '/ludoDB/Tests/LudoDBUtilityTest.php',
                'ludodbutilitytest' => '/ludoDB/Tests/LudoDBUtilityTest.php',
                'ludojs' => '/LudoJS.php',
                'ludojsparts' => '/LudoJSParts.php',
                'manager' => '/ludoDB/Tests/classes/Manager.php',
                'minify' => '/minify/min/lib/Minify.php',
                'minify_build' => '/minify/min/lib/Minify/Build.php',
                'minify_cache_apc' => '/minify/min/lib/Minify/Cache/APC.php',
                'minify_cache_file' => '/minify/min/lib/Minify/Cache/File.php',
                'minify_cache_memcache' => '/minify/min/lib/Minify/Cache/Memcache.php',
                'minify_commentpreserver' => '/minify/min/lib/Minify/CommentPreserver.php',
                'minify_controller_base' => '/minify/min/lib/Minify/Controller/Base.php',
                'minify_controller_files' => '/minify/min/lib/Minify/Controller/Files.php',
                'minify_controller_groups' => '/minify/min/lib/Minify/Controller/Groups.php',
                'minify_controller_minapp' => '/minify/min/lib/Minify/Controller/MinApp.php',
                'minify_controller_page' => '/minify/min/lib/Minify/Controller/Page.php',
                'minify_controller_version1' => '/minify/min/lib/Minify/Controller/Version1.php',
                'minify_css' => '/minify/min/lib/Minify/CSS.php',
                'minify_css_compressor' => '/minify/min/lib/Minify/CSS/Compressor.php',
                'minify_css_urirewriter' => '/minify/min/lib/Minify/CSS/UriRewriter.php',
                'minify_html' => '/minify/min/lib/Minify/HTML.php',
                'minify_importprocessor' => '/minify/min/lib/Minify/ImportProcessor.php',
                'minify_lines' => '/minify/min/lib/Minify/Lines.php',
                'minify_logger' => '/minify/min/lib/Minify/Logger.php',
                'minify_packer' => '/minify/min/lib/Minify/Packer.php',
                'minify_source' => '/minify/min/lib/Minify/Source.php',
                'minify_yuicompressor' => '/YUICompressor.php',
                'minify_yuicompressor_duplicate' => '/minify/min/lib/Minify/YUICompressor-duplicate.php',
                'movie' => '/ludoDB/Tests/classes/Movie.php',
                'mysqlitests' => '/ludoDB/Tests/MysqlITests.php',
                'noludodbclass' => '/ludoDB/Tests/classes/Dependencies/NoLudoDBClass.php',
                'package' => '/Package.php',
                'packageinterface' => '/CodeBuilderInterfaces.php',
                'pdotests' => '/ludoDB/Tests/PDOTests.php',
                'people' => '/ludoDB/Tests/classes/People.php',
                'peopleplain' => '/ludoDB/Tests/classes/PeoplePlain.php',
                'performancetest' => '/ludoDB/Tests/PerformanceTest.php',
                'person' => '/ludoDB/Tests/classes/Person.php',
                'personforconfigparser' => '/ludoDB/Tests/classes/PersonForConfigParser.php',
                'phone' => '/ludoDB/Tests/classes/Phone.php',
                'phonecollection' => '/ludoDB/Tests/classes/PhoneCollection.php',
                'puzzleall' => '/PuzzleAll.php',
                'requesthandlermock' => '/ludoDB/Tests/classes/RequestHandlerMock.php',
                'requesthandlertest' => '/ludoDB/Tests/RequestHandlerTest.php',
                'section' => '/ludoDB/Tests/classes/Section.php',
                'solar_dir' => '/minify/min/lib/Solar/Dir.php',
                'sqltest' => '/ludoDB/Tests/SQLTest.php',
                'testbase' => '/ludoDB/Tests/TestBase.php',
                'testcountry' => '/ludoDB/Tests/classes/TestCountry.php',
                'testgame' => '/ludoDB/Tests/classes/TestGame.php',
                'testnode' => '/ludoDB/Tests/classes/TestNode.php',
                'testnodes' => '/ludoDB/Tests/classes/TestNodes.php',
                'testnodeswithleafs' => '/ludoDB/Tests/classes/TestNodesWithLeafs.php',
                'testtable' => '/ludoDB/Tests/classes/TestTable.php',
                'testtimer' => '/ludoDB/Tests/classes/TestTimer.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd