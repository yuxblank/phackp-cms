<?php return
    [
        'routes' => [

            'GET' => [

                /**
                 * Backend section
                 */
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

                /**
                 * Content
                 */
                [
                    'url' => '/admin/content',
                    'class' => cms\controller\Admin::class,
                    'method' => 'content'
                ],
                [
                    'url' => '/admin/content/new',
                    'class' => cms\controller\Admin::class,
                    'method' => 'newContent'
                ],
                [
                    'url' => '/admin/content/edit/{id}',
                    'class' => cms\controller\Admin::class,
                    'method' => 'editContent'
                ],
                /**
                 * Categories
                 */
                [
                    'url' => '/admin/categories',
                    'class' => cms\controller\Admin::class,
                    'method' => 'categories'
                ],
                [
                    'url' => '/admin/category/new',
                    'class' => cms\controller\Admin::class,
                    'method' => 'newCategory'
                ],
                [
                    'url' => '/admin/category/edit/{id}',
                    'class' => cms\controller\Admin::class,
                    'method' => 'editCategory'
                ],
                [
                    'url' => '/admin/content/filter/{id}',
                    'class' => cms\controller\Admin::class,
                    'method' => 'filterItemsByCat'
                ],

                /**
                 * User
                 */
                [
                    'url' => '/admin/user',
                    'class' => cms\controller\Admin::class,
                    'method' => 'user'
                ],
                [
                    'url' => '/admin/user/new',
                    'class' => cms\controller\Admin::class,
                    'method' => 'newUser'
                ],
                [
                    'url' => '/admin/user/edit/{id}',
                    'class' => cms\controller\Admin::class,
                    'method' => 'editUser'
                ],

                /**
                 * Banner
                 */

                [

                    'url' => '/admin/banner',
                    'class' => cms\controller\Admin::class,
                    'method' => 'banner'

                ],

                [

                    'url' => '/admin/banner/new',
                    'class' => cms\controller\Admin::class,
                    'method' => 'newBanner'

                ],

                [

                    'url' => '/admin/banner/edit/{id}',
                    'class' => cms\controller\Admin::class,
                    'method' => 'editBanner'

                ],

                /**
                 * Config
                 */

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
                    /**
                     * Secure
                     */
                    'url' => '/admin/auth',
                    'class' => cms\controller\Secured::class,
                    'method' => 'authenticate',

                ],

                /**
                 * Crud operations
                 */
                [
                    'url' => '/admin/content/save',
                    'class' => cms\controller\Admin::class,
                    'method' => 'saveContent',
                ],

                [
                    'url' => '/admin/content/delete',
                    'class' => cms\controller\Admin::class,
                    'method' => 'deleteContent',
                ],

                [
                    'url' => '/admin/category/save',
                    'class' => cms\controller\Admin::class,
                    'method' => 'saveCategory',
                ],

                [
                    'url' => '/admin/category/delete',
                    'class' => cms\controller\Admin::class,
                    'method' => 'deleteCategory',
                ],
                [
                    'url' => '/admin/user/save',
                    'class' => cms\controller\Admin::class,
                    'method' => 'saveUser',
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
                    'class' => \controller\Errors::class,
                    'method' => 'page500'
                ]
            ]
        ]
    ];