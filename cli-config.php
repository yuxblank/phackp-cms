<?php

use cms\library\module\ModuleWire;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$loader = require __DIR__ .'/vendor/autoload.php';
$app = \yuxblank\phackp\core\Application::getInstance();

$doctrineConfig = require __DIR__ ."/admin/config/doctrine.php";
$doctrineConfig['doctrine.config']['entities_paths'] = [__DIR__ . '/admin/src/doctrine/model'];

$directories = glob(__DIR__ . '/admin/module' . '/*', GLOB_ONLYDIR);
$moduleEntitites = array();
foreach ($directories as $directory) {

    // first level module
    if (file_exists($directory . DIRECTORY_SEPARATOR . ModuleWire::BUNDLE_CONFIG)) {
        $config = json_decode(file_get_contents($directory . DIRECTORY_SEPARATOR . ModuleWire::BUNDLE_CONFIG));
        if (isset($config->database)){
            $moduleEntitites[] = $directory . DIRECTORY_SEPARATOR . $config->database->{'entities_path'};
        }
        $moduleGroup = glob($directory . '/*', GLOB_ONLYDIR);
        foreach ($moduleGroup as $subDirectory) {
            $config = json_decode(file_get_contents($subDirectory . DIRECTORY_SEPARATOR . ModuleWire::MODULE_CONFIG));
            if (isset($config->database)){
                $moduleEntitites[] = $subDirectory . DIRECTORY_SEPARATOR . $config->database->{'entities_path'};
            }
        }

    } else if (file_exists($directory . DIRECTORY_SEPARATOR . ModuleWire::MODULE_CONFIG)) {
        $config = json_decode(file_get_contents($directory . DIRECTORY_SEPARATOR . ModuleWire::BUNDLE_CONFIG));
        if (isset($config->database)){
            $moduleEntitites[] = $directory . DIRECTORY_SEPARATOR . $config->database->{'entities_path'};
        }
    }
}

$mergedList = array_merge($doctrineConfig['doctrine.config']['entities_paths'], $moduleEntitites);
$doctrineConfig['doctrine.config']['entities_paths']  = $mergedList;



$driver = new \yuxblank\phackp\database\driver\DoctrineDriver($doctrineConfig['doctrine.config']);
return ConsoleRunner::createHelperSet($driver->getDriver());