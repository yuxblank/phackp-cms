<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 00:40
 */

namespace cms\controller;


use yuxblank\phackp\http\api\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class UserController extends BaseUserController
{


    public function create(ServerRequestInterface $serverRequest)
    {

        if ($serverRequest->getMethod() === 'POST' && $crudResult = parent::create($serverRequest)){

            $crudResult->offsetGet('user');
            // do return
            $this->router->_switchAction('user.list');
        } else {
            $this->controlHeader->save = "#";
            $this->view->renderArgs('states', $this->states);
            $this->view->renderArgs('rolesList', $this->userRoleRepository->findAll());
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->render('/admin/user/new');
        }


    }

    public function read(ServerRequestInterface $serverRequest)
    {

        $crudResult = parent::read($serverRequest);
        if ($crudResult->offsetExists('user')) {

            // todo render urserlist
            $this->controlHeader->save = '#';
            $this->view->renderArgs('states', $this->userStates);
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->renderArgs('rolesList', $crudResult->offsetGet('rolesList'));
            $this->view->renderArgs('user', $crudResult->offsetGet('user'));
            $this->view->render("/admin/user/new");
        } else if ($crudResult->offsetExists('users')){
            // todo render user edit form
            $this->controlHeader->new = $this->router->link('admin/user/new');
            $this->controlHeader->delete = true;
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->renderArgs('users', $crudResult->offsetGet('users'));
            $this->view->render("/admin/user/index");
        }
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        if (parent::update($serverRequest)->offsetExists('user')){
            $this->router->switchAction('admin/user');
        }
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        return new JsonResponse(['result' => parent::delete($serverRequest)->offsetGet('users.removed')]);
    }


}