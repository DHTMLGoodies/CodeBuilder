<?php

require_once(dirname(__FILE__)."/autoload.php");

date_default_timezone_set("Europe/Berlin");
header("Content-type: application/json");


LudoDB::enableLogging();

$handler = new LudoDBRequestHandler();


echo $handler->handle(array("request" => "Builder/LudoJS/minify"));