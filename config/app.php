<?php
return [


    /**
     * Application informations
     */

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

        "APP_MODE" => "PRO",

        'OFFLINE' => false,


        'APP_URL' => 'http://localhost:7000', //

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
    'app.view' => [
        'ROOT' => 'src/view',
        'HOOKS' =>
            [
                'BANNER_BOX' => 'modules/banner_box.php',
                'SLIDESHOW' => 'modules/slideshow.php'
            ]
    ]
];