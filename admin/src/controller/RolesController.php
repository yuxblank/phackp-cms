<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 10/03/18
 * Time: 17.50
 */

namespace cms\controller;


use cms\doctrine\repository\UserRepository;
use cms\doctrine\repository\UserRoleRepository;
use cms\library\crud\CrudController;
use cms\library\crud\Response;
use cms\overrides\View;
use League\OAuth2\Server\ResourceServer;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

class RolesController extends Admin implements CrudController
{

    protected $userRoleRepository;

    /**
     * RolesController constructor.
     */
    public function __construct(View $view, Session $session, Router $router, UserRepository $userRepository,ResourceServer $resourceServer, ServerRequestInterface $serverRequest, UserRoleRepository $userRoleRepository)
    {
        parent::__construct($view,$session,$router,$userRepository,$resourceServer, $serverRequest);
        $this->userRoleRepository = $userRoleRepository;
    }


    public function create(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement create() method.
    }

    public function read(ServerRequestInterface $serverRequest)
    {
        if ($this->serverRequest->getPathParams()){

        }

        $roles = $this->userRoleRepository->findAll();
        return Response::ok($roles)->build();
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