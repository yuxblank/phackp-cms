<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 12.09
 */


use cms\module\core\core_menu\controller\MenuController;
return [
    'GET' => [
        [
            'url' => '/admin/menu',
            'class' => MenuController::class,
            'method' => 'read',
            'alias' => 'menu.list'
        ],
        [
            'url' => '/admin/menu/{title}',
            'class' => MenuController::class,
            'method' => 'read',
            'alias' => 'menu.read'
        ],
    ],
    'POST' => [

    ]
];