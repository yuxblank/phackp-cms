<?php return
    [
        'routes' => [

            'GET' => [
                [
                    'url' => '/admin/login',
                    'class' => cms\controller\AuthController::class,
                    'method' => 'login',
                    'alias' => 'auth.login'
                ],
                [
                    'url' => '/admin/logout',
                    'class' => cms\controller\AuthController::class,
                    'method' => 'logout'
                ],
                [
                    'url' => '/admin',
                    'class' => cms\controller\HomeController::class,
                    'method' => 'index'
                ],


                /**
                 * User
                 */
                [
                    'url' => '/admin/user',
                    'class' => cms\controller\UserController::class,
                    'method' => 'read',
                    'alias' => 'user.list'
                ],
                [
                    'url' => '/admin/user/new',
                    'class' => cms\controller\UserController::class,
                    'method' => 'create',
                    'alias' => 'user.create'
                ],
                [
                    'url' => '/admin/user/edit/{id}',
                    'class' => cms\controller\UserController::class,
                    'method' => 'read',
                    'alias' => 'user.edit'
                ],
                [
                    'url' => '/admin/configuration',
                    'class' => cms\controller\ConfigurationController::class,
                    'method' => 'read'
                ],
                [
                    'url' => 'clienti',
                    'class' => cms\controller\Admin::class,
                    'method' => 'customers'
                ],
            ],

            'POST' => [
                [
                    'url' => '/admin/auth',
                    'class' => cms\controller\AuthController::class,
                    'method' => 'authenticate',
                ],
                [
                    'url' => '/admin/user/save',
                    'class' => cms\controller\UserController::class,
                    'method' => 'create',
                    'alias' => 'user.save'
                ],
                [
                    'url' => '/admin/user/delete',
                    'class' => cms\controller\Admin::class,
                    'method' => 'deleteUser',
                ],


                /**
                 * Sitemap
                 */

                [
                    'url' => '/admin/sitemap',
                    'class' => cms\controller\ConfigurationController::class,
                    'method' => 'generateSitmap',
                ],
            ],
            'PUT' => [
            ],

            'PATCH' => [
            ],

            'DELETE' => [
            ],

            'HEAD' => [
            ],

            'OPTIONS' => [
            ],


            /**
             * ERROR is not HTTP. Is used for pHackp error page mapping.
             */


            'ERROR' => [
                404 =>
                    [
                        'url' => '/notfound',
                        'class' => \controller\Errors::class,
                        'method' => 'page404'
                    ],
                500 => [
                    'url' => '/error',
                    'class' => \cms\controller\Errors::class,
                    'method' => 'error'
                ]
            ]
        ]
    ];