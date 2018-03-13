<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 10/03/18
 * Time: 17.50
 */

namespace cms\controller;


use cms\doctrine\model\UserRole;
use cms\doctrine\repository\UserRepository;
use cms\doctrine\repository\UserRoleRepository;
use cms\library\crud\CrudController;
use cms\library\crud\Response;
use cms\model\UserFactory;
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
        $role = UserFactory::roleFactory(new UserRole(), $serverRequest->getParsedBody());
        $this->userRoleRepository->save($role);
        return Response::ok($role)->build();
    }

    public function read(ServerRequestInterface $serverRequest)
    {
        if ($this->serverRequest->getPathParams()){

            $role = $this->userRoleRepository->find($this->serverRequest->getPathParams()['id']);
            if ($role) {
                return Response::ok($role)->build();
            }
        }

        $roles = $this->userRoleRepository->findAll();
        return Response::ok($roles)->build();
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        $role = $this->userRoleRepository->find($serverRequest->getParsedBody()['id']);
        UserFactory::roleFactory($role, $serverRequest->getParsedBody());

        $this->userRoleRepository->update($role);
        return Response::ok($role)->build();

    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        $id = (int) $serverRequest->getPathParams()['id'];

        $role = $this->userRoleRepository->find($id);

        $this->userRoleRepository->delete($role);

        return Response::ok($role)->build();


    }
}