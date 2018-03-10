<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 12.09
 */


use core\core_content\controller\CategoriesController;
use core\core_content\controller\ContentController;

return [
    'GET' => [
        [
            'url' => '/admin/content',
            'class' => ContentController::class,
            'method' => 'read',
            'alias' => 'content.list'
        ],
        [
            'url' => '/admin/content/new',
            'class' => ContentController::class,
            'method' => 'create',
            'alias' => 'content.create'
        ],
        [
            'url' => '/admin/content/{id}',
            'class' => ContentController::class,
            'method' => 'read',
            'alias' => 'content.edit'
        ],
        [
            'url' => '/admin/api/articles',
            'class' => \cms\module\core\core_content\controller\ContentApi::class,
            'method' => 'getArticles',
            'alias' => 'api.articles'
        ],
        /**
         * Categories
         */
        [
            'url' => '/admin/categories',
            'class' => CategoriesController::class,
            'method' => 'read',
            'alias' => 'category.list'
        ],
        [
            'url' => '/admin/category/{id}',
            'class' => CategoriesController::class,
            'method' => 'read',
            'alias' => 'category.edit'
        ],
        [
            'url' => '/admin/api/categories',
            'class' => \cms\module\core\core_content\controller\ContentApi::class,
            'method' => 'getCategories',
            'alias' => 'api.categories'
        ],
    ],
    'POST' => [
        [
            'url' => '/admin/content',
            'class' => ContentController::class,
            'method' => 'create',
        ],
        /**
         * Categories
         */
        [
            'url' => '/admin/category',
            'class' => CategoriesController::class,
            'method' => 'create',
        ],
    ],
    'PUT' => [
        [
            'url' => '/admin/content',
            'class' => ContentController::class,
            'method' => 'update',
        ],
        [
            'url' => '/admin/category',
            'class' => CategoriesController::class,
            'method' => 'update',
        ],
    ],
    'DELETE' => [
        [
            'url' => '/admin/content/{id}',
            'class' => ContentController::class,
            'method' => 'delete',
        ],
        [
            'url' => '/admin/category/{id}',
            'class' => CategoriesController::class,
            'method' => 'delete',
        ],
    ]
];