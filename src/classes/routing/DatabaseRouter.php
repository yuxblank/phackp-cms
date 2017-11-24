<?php

use cms\doctrine\repository\ActionRepository;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\exception\RouterException;

/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/10/2017
 * Time: 19:39
 */
class DatabaseRouter implements \yuxblank\phackp\routing\api\Router
{

    private $serverRequest;
    private $actionRespository;

    /**
     * DatabaseRouter constructor.
     * @param ServerRequestInterface $serverRequest
     * @param ActionRepository $actionRepository
     */
    public function __construct(ServerRequestInterface $serverRequest, ActionRepository $actionRepository)
    {
        $this->serverRequest = $serverRequest;
        $this->actionRespository = $actionRepository;

    }

    private function resolveModule()
    {
        $this->serverRequest->getUri()->getPath();
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

    /**
     * @return Route
     * @throws RouterException
     */
    public function findAction(): \yuxblank\phackp\routing\api\RouteInterface
    {

        $module = $this->resolveModule();

        if ($module) {

            // create module route to get action

            // if the url is the same static route, just return!
            if ($route['url'] === $this->serverRequest->getUri()->getPath()) {
                return $this->createRouteFromArray($route);
            }
            // find wildcard
            if (preg_match(self::WILDCARD_REGEXP, $route['url'])) {
                $routeArray = preg_split('@/@', $route['url'], NULL, PREG_SPLIT_NO_EMPTY);
                $queryArray = preg_split('@/@', $this->serverRequest->getUri()->getPath(), NULL, PREG_SPLIT_NO_EMPTY);
                $url = $this->compareRoutes($routeArray, $queryArray);
                // if compare routes matched and the url has been recreated, return this route
                if ($url !== null) {
                    $route['params'] = $this->getWildCardParams($routeArray, $queryArray);
                    return $this->createRouteFromArray($route);
                }
            }
        }
        throw new RouterException("Route not found", RouterException::NOT_FOUND);

    }

    private function resolveModuleAction(string $module, ServerRequestInterface $serverRequest){
        $actions = $this->actionRespository->getActionsByModule($module);

        if ($actions) {

            // resolve action

        }

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