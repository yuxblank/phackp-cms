<?php

use Psr\Container\ContainerInterface;

return [

    \cms\overrides\View::class => function (ContainerInterface $container) {
        return new \cms\overrides\View($container->get('app.view'),
            array_merge($container->get('app.globals'), ['APP_ROOT' => \yuxblank\phackp\core\Application::$ROOT]),
            $container->get(\yuxblank\phackp\routing\api\Router::class));
    }

];