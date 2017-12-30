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