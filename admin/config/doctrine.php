<?php

use yuxblank\phackp\core\Application;

return [
    'doctrine.config' => [
        'entities_paths' => [Application::$ROOT . "/doctrine/model"],
        'is_dev' => true,
        'proxy_dir' => null,
        'cache' => null,
        'simple_annotations' => false,
        'connection' =>
            [
                'driver'   => 'pdo_mysql',
                'user'     => 'root',
                'password' => 'muska88',
                'dbname'   => 'phackpcms',
            ],
        'transaction' => \yuxblank\phackp\database\driver\DoctrineDriver::CONTAINER_MANAGED
    ]
];