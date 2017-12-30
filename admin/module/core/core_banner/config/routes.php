<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 12.09
 */


use core\core_banner\controller\BannerController;

return [
    'GET' => [
        [
            'url' => '/admin/banner',
            'class' => BannerController::class,
            'method' => 'read'
        ],
        [
            'url' => '/admin/banner/new',
            'class' => BannerController::class,
            'method' => 'create'
        ],
        [
            'url' => '/admin/banner/edit/{id}',
            'class' => BannerController::class,
            'method' => 'update'
        ],
    ],
    'POST' => [
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
    ]
];