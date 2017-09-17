<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 00:40
 */

namespace cms\controller;


use cms\doctrine\model\User;
use cms\doctrine\repository\UserRepository;
use cms\doctrine\repository\UserRoleRepository;
use cms\library\crud\CrudController;
use cms\model\UserRole;
use cms\overrides\View;
use Doctrine\ORM\Persisters\PersisterException;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

class UserController extends Admin implements CrudController
{

    private $userRoleRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param UserRoleRepository $userRoleRepository
     * @param View $view
     * @param Session $session
     * @param Router $router
     * @internal param UserRoleServices $userRoleServices
     */
    public function __construct(UserRepository $userRepository, UserRoleRepository $userRoleRepository, View $view, Session $session, Router $router)
    {
        parent::__construct($view, $session, $router, $userRepository);
        $this->userRoleRepository = $userRoleRepository;
    }

    public function create(ServerRequestInterface $serverRequest)
    {

        if ($serverRequest->getMethod() === 'POST') {

            $email = filter_var($serverRequest->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
            $userrole_id = filter_var($serverRequest->getParsedBody()['role'], FILTER_SANITIZE_NUMBER_INT);

            $password = filter_var($serverRequest->getParsedBody()['password'], FILTER_SANITIZE_STRING);
            $status = filter_var($serverRequest->getParsedBody()['status'], FILTER_SANITIZE_NUMBER_INT);

            try {
                /** @var \cms\doctrine\model\UserRole $userrole */
                $userrole = $this->userRoleRepository->find($userrole_id);
                $this->userRepository->createUser($email, $password, $email, $userrole);
                $this->router->switchAction('admin/user');
            } catch (PersisterException $exception) {
                throw new PersisterException($exception);
            }


        } else {

            $this->controlHeader->save = "#";

            $this->view->renderArgs("states", $user->getStates());

            $this->view->renderArgs('user', $user);
            $this->view->renderArgs('rolesList', $this->userRoleServices->getRoles());

            $this->view->renderArgs('controlHeader', $this->controlHeader);

            $this->view->render("/admin/user/new");
        }


    }

    public function read(ServerRequestInterface $serverRequest)
    {

        $id = filter_var($serverRequest->getPathParams()['id'], FILTER_SANITIZE_NUMBER_INT);
        if ($id) {

            // todo block edit of sa

            $this->controlHeader->save = "#";

            $this->view->renderArgs("states", $this->states);

            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->renderArgs('rolesList', $this->userRoleRepository->findAll());

            $this->view->renderArgs('user', $this->userRepository->find($id));

            $this->view->render("/admin/user/new");
        } else {

            if ($this->loadUser()->isSuperUser()) {

                $this->view->renderArgs('users', $this->userRepository->findAll());

            } else {

                /** @var UserRole $userRole */

                $userRole = $userRole->find("WHERE level <=?", 3);
                $this->view->renderArgs('users', $userRole->users());

            }

            $this->controlHeader->new = $this->router->link('admin/user/new');

            $this->controlHeader->delete = true;

            $this->view->renderArgs('controlHeader', $this->controlHeader);

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