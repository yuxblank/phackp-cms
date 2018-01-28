<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/06/2017
 * Time: 00:03
 */
use yuxblank\phackp\core\Application;
$loader = require '../vendor/autoload.php';
$app = Application::getInstance();

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

$app->bootstrap(__DIR__);
$app->container()->set(\cms\library\module\ModuleWire::class, new \cms\library\module\ModuleWire());
try {
    /** @var \cms\library\module\ModuleWire $moduleWire */
    $moduleWire = $app->container()->make(\cms\library\module\ModuleWire::class);
    $moduleWire->registerModules();
    $moduleWire->finalize();
} catch (\DI\DependencyException $e) {
} catch (\DI\NotFoundException $e) {
}
/*$app->registerService(\yuxblank\phackp\services\ErrorHandlerProvider::class,true);*/
$app->run();