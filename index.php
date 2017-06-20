<?php
use yuxblank\phackp\services\ErrorHandlerProvider;

ini_set("log_errors", 1);
ini_set("error_log", __DIR__."/logs/php-error.log");
$loader = require __DIR__ . '/vendor/autoload.php';
$App = yuxblank\phackp\core\Application::getInstance();
$App->bootstrap(__DIR__);
/*$App->registerService(ErrorHandlerProvider::class,true);*/
$App->run();