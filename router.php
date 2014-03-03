<?php

require_once(dirname(__FILE__)."/autoload.php");

date_default_timezone_set("Europe/Berlin");
header("Content-type: application/json");
error_reporting(E_ALL);
ini_set('display_errors','on');
/**
 * TODO move this code
 */
require_once("database-connection.php");

LudoDB::enableLogging();

// For static(No db) installations

$request = array('request' => isset($_GET['request']) ? $_GET['request'] : $_POST['request']);

if(isset($_POST['data'])){
    $request['data'] = isset($_POST['data']) ? $_POST['data'] : null;
}

if(isset($_POST['arguments'])){
    $request['arguments'] = $_POST['arguments'];
}

$handler = new LudoDBRequestHandler();

var_dump($request);



echo $handler->handle($request);


