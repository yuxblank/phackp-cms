<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 30/12/17
 * Time: 12.54
 */

namespace cms\controller;


use cms\controller\Admin;
use cms\doctrine\model\Menu;
use cms\doctrine\repository\MenuRepository;
use cms\doctrine\repository\UserRepository;
use cms\library\crud\CrudController;
use cms\library\crud\CrudResult;
use cms\overrides\View;

use League\OAuth2\Server\ResourceServer;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

abstract class BaseMenuController extends Admin implements CrudController
{

    protected $menuRepository;

    public function __construct(View $view, Session $session, Router $router, UserRepository $userRepository, MenuRepository $menuRepository, ResourceServer $resourceServer, ServerRequestInterface $serverRequest)
    {
        parent::__construct($view, $session, $router, $userRepository, $resourceServer, $serverRequest);
        $this->menuRepository = $menuRepository;
    }


    /**
     * @param ServerRequestInterface $serverRequest
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @return CrudResult $result
     */
    public function create(ServerRequestInterface $serverRequest)
    {
        $result = new CrudResult();
        if ($serverRequest->getMethod() === 'POST') {

            $requestObject = $serverRequest->getParsedBody();

            $menu = new Menu();
            $menu->setTitle(filter_var($requestObject['title'], FILTER_SANITIZE_STRING));
            $menu->setAlias(filter_var($requestObject['alias'], FILTER_SANITIZE_STRING));
            $this->menuRepository->save($menu);
            $result->offsetSet('menu', $menu);
        }
        return $result;
    }

    /**
     * @param ServerRequestInterface $serverRequest
     * @return CrudResult
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function read(ServerRequestInterface $serverRequest)
    {
        $result = new CrudResult();
        if ($serverRequest->getPathParams() !== null) {
            $menu = $this->menuRepository->findByTitle($serverRequest->getPathParams()['title']);
            $result->offsetSet('menu', $menu);
        } else {
            $menu = $this->menuRepository->findAll();
            $result->offsetSet('menu.list', $menu);
        }

        return $result;
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement update() method.
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement delete() method.
    }


}