<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 00:40
 */

namespace cms\controller;


use Ardent\Collection\HashMap;
use cms\doctrine\model\User;
use cms\model\UserRole;
use Collections\Map;
use Collections\Pair;
use Collections\Set;
use Doctrine\ORM\Persisters\PersisterException;
use http\Url;
use yuxblank\phackp\http\api\ServerRequestInterface;

class UserController extends BaseUserController
{


    public function create(ServerRequestInterface $serverRequest)
    {

        if ($crudResult = parent::create($serverRequest)){

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

        $email = filter_var($serverRequest->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $userrole_id = filter_var($serverRequest->getParsedBody()['role'], FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($serverRequest->getParsedBody()['password'], FILTER_SANITIZE_STRING);
        $status = filter_var($serverRequest->getParsedBody()['status'], FILTER_SANITIZE_NUMBER_INT);

        try {
            /** @var \cms\doctrine\model\UserRole $userrole */
            $userrole = $this->userRoleRepository->find($userrole_id);
            $this->userRepository->updateUserDetails($email, $email, $status,$userrole,$password);
            $this->router->switchAction('admin/user');
        } catch (PersisterException $exception) {
            throw new PersisterException($exception);
        }


    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        $ids = $serverRequest->getParsedBody()['ids'];

        $deleted = 0;

        if ($ids !== null && count($ids) > 0) {

            $User = new User();

            foreach ($ids as $id) {

                $User->delete($id);

                $deleted++;

            }

        }
        echo $deleted;

    }


}