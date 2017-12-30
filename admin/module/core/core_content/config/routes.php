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
            'url' => '/admin/content/edit/{id}',
            'class' => ContentController::class,
            'method' => 'read',
            'alias' => 'content.edit'
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
            'url' => '/admin/category/new',
            'class' => CategoriesController::class,
            'method' => 'create',
            'alias' => 'category.create'
        ],
        [
            'url' => '/admin/category/edit/{id}',
            'class' => CategoriesController::class,
            'method' => 'read',
            'alias' => 'category.edit'
        ],
    ],
    'POST' => [
        [
            'url' => '/admin/content/save',
            'class' => ContentController::class,
            'method' => 'create',
        ],
        [
            'url' => '/admin/content/delete',
            'class' => ContentController::class,
            'method' => 'delete',
        ],
        /**
         * Categories
         */
        [
            'url' => '/admin/category/save',
            'class' => CategoriesController::class,
            'method' => 'create',
        ],
        [
            'url' => '/admin/category/delete',
            'class' => CategoriesController::class,
            'method' => 'delete',
        ],
    ]
];