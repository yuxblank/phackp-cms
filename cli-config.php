<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$loader = require __DIR__ .'/vendor/autoload.php';
\yuxblank\phackp\core\Application::getInstance()->bootstrap( __DIR__ . "/admin");
$config = require __DIR__ ."/admin/config/doctrine.php";
$config['doctrine.config']['entities_paths'] = [__DIR__ . '/admin/src/doctrine/model'];
$driver = new \yuxblank\phackp\database\driver\DoctrineDriver($config['doctrine.config']);
return ConsoleRunner::createHelperSet($driver->getDriver());