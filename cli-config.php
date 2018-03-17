<?php

use cms\library\module\ModuleWire;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use yuxblank\phackp\database\driver\DoctrineDriver;

$loader = __DIR__ . 'vendor/autoload.php';
$app = \yuxblank\phackp\core\Application::getInstance();

$doctrineConfig = require "config/doctrine.php";
$doctrineConfig['doctrine.config']['entities_paths'] = [__DIR__ . '/src/doctrine/model'];
$driver = new DoctrineDriver($doctrineConfig['doctrine.config']);
return ConsoleRunner::createHelperSet($driver->getDriver());