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

                [
                    'url' => '/admin/banner',
                    'class' => \cms\controller\BannerController::class,
                    'method' => 'read'
                ],
                [
                    'url' => '/admin/banner/new',
                    'class' => \cms\controller\BannerController::class,
                    'method' => 'create'
                ],
                [
                    'url' => '/admin/banner/edit/{id}',
                    'class' => \cms\controller\BannerController::class,
                    'method' => 'update'
                ],

                [
                    'url' => '/admin/content',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'read',
                    'alias' => 'content.list'
                ],
                [
                    'url' => '/admin/content/new',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'create',
                    'alias' => 'content.create'
                ],
                [
                    'url' => '/admin/content/{id}',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'read',
                    'alias' => 'content.edit'
                ],
                [
                    'url' => '/admin/api/articles',
                    'class' => \cms\controller\ContentApi::class,
                    'method' => 'getArticles',
                    'alias' => 'api.articles'
                ],
                [
                    'url' => '/admin/api/article/{id}',
                    'class' => \cms\controller\ContentApi::class,
                    'method' => 'getArticle',
                    'alias' => 'api.article'
                ],
                /**
                 * Categories
                 */
                [
                    'url' => '/admin/categories',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'read',
                    'alias' => 'category.list'
                ],
                [
                    'url' => '/admin/category/{id}',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'read',
                    'alias' => 'category.edit'
                ],
                [
                    'url' => '/admin/api/categories',
                    'class' => \cms\controller\ContentApi::class,
                    'method' => 'getCategories',
                    'alias' => 'api.categories'
                ],

                [
                    'url' => '/admin/menu',
                    'class' => \cms\controller\MenuController::class,
                    'method' => 'read',
                    'alias' => 'menu.list'
                ],
                [
                    'url' => '/admin/menu/{id}',
                    'class' => \cms\controller\MenuController::class,
                    'method' => 'read',
                    'alias' => 'menu.read'
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


                [
                    'url' => '/admin/banner/save',
                    'class' => cms\controller\Admin::class,
                    'method' => 'saveBanner',

                ],
                [
                    'url' => '/admin/banner/upload',
                    'class' => cms\controller\Admin::class,
                    'method' => 'uploadBanner',
                ],
                [
                    'url' => '/admin/banner/delete',
                    'class' => cms\controller\Admin::class,
                    'method' => 'deleteBanner',
                ],

                [
                    'url' => '/admin/content',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'create',
                ],
                /**
                 * Categories
                 */
                [
                    'url' => '/admin/category',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'create',
                ],

                [
                    'url' => '/admin/menu',
                    'class' => \cms\controller\MenuController::class,
                    'method' => 'create',
                    'alias' => 'menu.save'
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
                [
                    'url' => '/admin/content',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'update',
                ],
                [
                    'url' => '/admin/category',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'update',
                ],
                [
                    'url' => '/admin/menu',
                    'class' => \cms\controller\MenuController::class,
                    'method' => 'update',
                    'alias' => 'menu.update'
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
                [
                    'url' => '/admin/content/{id}',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'delete',
                ],
                [
                    'url' => '/admin/category/{id}',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'delete',
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
                        'class' => \cms\controller\Errors::class,
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