<?php

return
    [
        'routes' => [

            'GET' => [

                [
                    'url' => '/admin/authentication/verify/{access_token}',
                    'method' => 'verifyToken',
                    'class' => cms\controller\AuthController::class

                ],

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
                    'url' => '/admin/user/{id}',
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

                /** Roles */
                [
                    'url' => '/admin/role',
                    'class' => cms\controller\RolesController::class,
                    'method' => 'read',
                    'alias' => 'role.list'
                ],
                /** Roles */
                [
                    'url' => '/admin/role/{id}',
                    'class' => cms\controller\RolesController::class,
                    'method' => 'read',
                    'alias' => 'role.edit'
                ],
            ],

            'POST' => [
                [
                    'url' => '/admin/auth/login',
                    'method' => 'getToken',
                    'class' => cms\controller\AuthController::class,
                ],
                [
                    'url' => '/admin/auth',
                    'class' => cms\controller\AuthController::class,
                    'method' => 'authenticate',
                ],
                [
                    'url' => '/admin/user',
                    'class' => cms\controller\UserController::class,
                    'method' => 'create',
                    'alias' => 'user.save'
                ],

                [
                    'url' => '/admin/role',
                    'class' => cms\controller\RolesController::class,
                    'method' => 'create',
                    'alias' => 'role.create'
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
                [
                    'url' => '/admin/user',
                    'class' => cms\controller\UserController::class,
                    'method' => 'update',
                    'alias' => 'user.update'
                ],
                [
                    'url' => '/admin/role',
                    'class' => cms\controller\RolesController::class,
                    'method' => 'update',
                    'alias' => 'role.update'
                ],
            ],

            'PATCH' => [
            ],

            'DELETE' => [
                [
                    'url' => '/admin/user/{id}',
                    'class' => cms\controller\UserController::class,
                    'method' => 'delete',
                    'alias' => 'user.delete'
                ],
                [
                    'url' => '/admin/role/{id}',
                    'class' => cms\controller\RolesController::class,
                    'method' => 'delete',
                    'alias' => 'role.delete'
                ],
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