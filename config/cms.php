<?php
return [


    'cms.globals' => [

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


    'cms.view' =>
        [
            'ROOT' => 'src/cms/view',
            'HOOKS' =>
                [

                ]
        ]


];