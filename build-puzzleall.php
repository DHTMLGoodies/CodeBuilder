<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alf Magne
 * Date: 03.03.14
 * Time: 17:29
 * To change this template use File | Settings | File Templates.
 */

require_once(dirname(__FILE__)."/autoload.php");


$request = array(
    'request' => 'Builder/PuzzleAll/minify'
);

Builder::disableDB();

$handler = new LudoDBRequestHandler();


echo $handler->handle($request);