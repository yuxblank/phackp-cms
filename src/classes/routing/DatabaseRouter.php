<?php

use yuxblank\phackp\http\api\ServerRequestInterface;

/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/10/2017
 * Time: 19:39
 */

class DatabaseRouter implements \yuxblank\phackp\routing\api\Router
{

    private $serverRequest;

    /**
     * DatabaseRouter constructor.
     * @param ServerRequestInterface $serverRequest
     */
    public function __construct(ServerRequestInterface $serverRequest)
    {
        $this->serverRequest =  $serverRequest;

    }

    public function link(string $link, array $params = null): string
    {
        // TODO: Implement link() method.
    }

    public function alias(string $alias, String $method = null, array $params = null): string
    {
        // TODO: Implement alias() method.
    }

    public function redirect(\Psr\Http\Message\UriInterface $uri)
    {
        // TODO: Implement redirect() method.
    }

    public function switchAction(string $uri, array $params = null)
    {
        // TODO: Implement switchAction() method.
    }

    public function _switchAction(string $alias, array $params = null)
    {
        // TODO: Implement _switchAction() method.
    }

    public function findAction(): \yuxblank\phackp\routing\api\RouteInterface
    {
        $path = $this->serverRequest->getUri()->getPath();
    }

    public function getErrorRoute(int $code): \yuxblank\phackp\routing\api\RouteInterface
    {
        // TODO: Implement getErrorRoute() method.
    }

    public function match(ServerRequestInterface $request): bool
    {
        // TODO: Implement match() method.
    }

    public function generateUri(\yuxblank\phackp\routing\api\RouteInterface $route): \Psr\Http\Message\UriInterface
    {
        // TODO: Implement generateUri() method.
    }


}