<?php

use yuxblank\phackp\core\Application;

return [


    'app.globals' => [

        "APP_NAME" => 'AppKit',
        "APP_VERSION" => '1.0',


        /**
         * Author informations
         */
        "AUTHOR" =>
            [
                "NAME" => "Yuri Blanc",
                "EMAIL" => "yuxblank@gmail.com"
            ],

        /**
         * App filesystem settings
         */

        /* "APP_ROOT" => __DIR__ ,*/


        /**
         * App status
         */

        "APP_MODE" => "DEV",

        'OFFLINE' => false,


        'APP_URL' => 'http://localhost:9001', //

        /**
         * Oauth2 Server config
         */
        'OAUTH2' => [
            'PRIVATE_KEY' => \yuxblank\phackp\core\Application::$ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'private.key',
            'PUBLIC_KEY' => \yuxblank\phackp\core\Application::$ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'public.key',
            'ENCRYPTION_KEY' => 'FpXzmrNwbztlOmkg4avXhsDa8YVVhTzqC0wUyAtdjhk='
        ]

    ],

    'app.http' => [
        /**
         * Rest settings
         */
        "GZIP" => false,
        'INJECT_QUERY_STRING' => true,

    ],

    'app.session' => [
        /**
         * Cookies and Sessions
         */

        'LIFETIME' => 1024,
        'USE_COOKIES' => false,
        'NAME' => 'pHackp-session',
        'COOKIE' =>
            [
                'PATH' => '/',
                'DOMAIN' => $_SERVER['HTTP_HOST'],
                'SECURE' => isset($_SERVER['HTTPS']),
                'HTTP_ONLY' => false
            ]

    ],


    'app.view' =>
        [
            'ROOT' => 'themes/core',
            'HOOKS' =>
                [

                ]
        ],

    'app.security' => [
        'keystore' => [
            'path' => Application::$ROOT . DIRECTORY_SEPARATOR .'keystore',
            'passphrase' => 'test'
        ]
    ]


];