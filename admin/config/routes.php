<?php return
    [
        'routes' => [

            'GET' => [
                [
                    'url' => '/admin/login',
                    'class' => cms\controller\Secured::class,
                    'method' => 'login'
                ],
                [
                    'url' => '/admin/logout',
                    'class' => cms\controller\Secured::class,
                    'method' => 'logout'
                ],
                [
                    'url' => '/admin',
                    'class' => cms\controller\Admin::class,
                    'method' => 'index'
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
                    'url' => '/admin/content/edit/{id}',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'read',
                    'alias' => 'content.edit'
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
                    'url' => '/admin/category/new',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'create',
                    'alias' => 'category.create'
                ],
                [
                    'url' => '/admin/category/edit/{id}',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'read',
                    'alias' => 'category.edit'
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
                    'method' => 'update',
                    'alias' => 'user.edit'
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
                    'url' => '/admin/configuration',
                    'class' => cms\controller\Admin::class,
                    'method' => 'config'
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
                    'class' => cms\controller\Secured::class,
                    'method' => 'authenticate',
                ],
                [
                    'url' => '/admin/content/save',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'create',
                ],
                [
                    'url' => '/admin/content/delete',
                    'class' => \cms\controller\ContentController::class,
                    'method' => 'delete',
                ],
                [
                    'url' => '/admin/category/save',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'create',
                ],
                [
                    'url' => '/admin/category/delete',
                    'class' => \cms\controller\CategoriesController::class,
                    'method' => 'delete',
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

                /**
                 * Sitemap
                 */

                [
                    'url' => '/admin/sitemap',
                    'class' => cms\controller\Admin::class,
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