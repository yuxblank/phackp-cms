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
$app->run();