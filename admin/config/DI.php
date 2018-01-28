<?php

use cms\doctrine\repository\OAuthAccessTokenRepository;
use cms\doctrine\repository\OAuthClientRepository;
use cms\doctrine\repository\OAuthScopeRepository;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use Psr\Container\ContainerInterface;

return [

    \cms\overrides\View::class => function (ContainerInterface $container) {
        return new \cms\overrides\View($container->get('app.view'),
            array_merge($container->get('app.globals'), ['APP_ROOT' => \yuxblank\phackp\core\Application::$ROOT]),
            $container->get(\yuxblank\phackp\routing\api\Router::class));
    },
    ClientRepositoryInterface::class => \DI\object(OAuthClientRepository::class),
    AccessTokenRepositoryInterface::class => DI\object(OAuthAccessTokenRepository::class),
    ScopeRepositoryInterface::class => DI\object(OAuthScopeRepository::class),
    \League\OAuth2\Server\AuthorizationServer::class => function (\Psr\Container\ContainerInterface $c) {
        return new \League\OAuth2\Server\AuthorizationServer(
            $c->get(ClientRepositoryInterface::class),
            $c->get(AccessTokenRepositoryInterface::class),
            $c->get(ScopeRepositoryInterface::class),
            $c->get('app.globals')['OAUTH2']['PRIVATE_KEY'],
            $c->get('app.globals')['OAUTH2']['ENCRYPTION_KEY']);
    },
    \League\OAuth2\Server\ResourceServer::class => function (\Psr\Container\ContainerInterface $c){
        return new \League\OAuth2\Server\ResourceServer(
            $c->get(AccessTokenRepositoryInterface::class),
            $c->get('app.globals')['OAUTH2']['PUBLIC_KEY']);
    }

];