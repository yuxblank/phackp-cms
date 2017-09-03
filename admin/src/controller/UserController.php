<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 00:40
 */

namespace cms\controller;


use cms\library\crud\CrudController;
use cms\model\services\UserRoleServices;
use cms\model\services\UserServices;
use cms\model\User;
use cms\model\UserRole;
use cms\overrides\View;
use Psr\Http\Message\ServerRequestInterface;
use yuxblank\phackp\core\Crypto;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\routing\api\Router;

class UserController extends Admin implements CrudController
{

    private $userServices;
    private $userRoleServices;
    private $controlHeader;

    /**
     * UserController constructor.
     * @param UserServices $userServices
     * @param UserRoleServices $userRoleServices
     * @param View $view
     * @param Session $session
     * @param Router $router
     */
    public function __construct(UserServices $userServices, UserRoleServices $userRoleServices, View $view, Session $session, Router $router)
    {
        parent::__construct($view, $session, $router);
        $this->userServices = $userServices;
        $this->userRoleServices = $userRoleServices;
        $this->controlHeader = new \stdClass();
    }

    public function create(ServerRequestInterface $serverRequest)
    {
        $user = new User();

        if ($serverRequest->getMethod() === 'POST') {
            if ($serverRequest->getParsedBody()['id'] !== null && $serverRequest->getParsedBody()['id'] !== '') {

                $user->id = filter_var($serverRequest->getParsedBody()['id'], FILTER_SANITIZE_NUMBER_INT);

            }

            $user->email = filter_var($serverRequest->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);

            $user->userrole_id = $serverRequest->getParsedBody()['role'];

            $Crypto = new Crypto();

            if (isset($serverRequest->getParsedBody()['password']) && $serverRequest->getParsedBody()['password'] != "") {

                $user->password = $Crypto->generateHash($serverRequest->getParsedBody()['password']);

            }

            $user->status = $serverRequest->getParsedBody()['status'];

            if (!empty($user->email)) {

                if ($user->id != null) {

                    // TODO ACL

                    if ($user->role()->level == 3 && !Secured::loadUser()->isSuperAdmin()) {

                        die("You are not authorized to promote superusers");

                    }


                    if ($user->update()) {

                        $this->keep('success', "Aggiornamento effettuato con successo");

                    } else {

                        $this->keep('success', "Un errore ha impedito il salvataggio");

                    }

                } else {

                    $user->date_created = date('Y-m-d H:i:s');


                    // TODO ACL

                    if ($user->role()->id == 3 && !Secured::loadUser()->isSuperAdmin()) {

                        die("You are not authorized to create superusers");

                    }


                    if ($user->alreadyExist()) {

                        die("This email already belongs to another user");

                    }


                    if ($user->save()) {

                        $this->keep('success', "Salvataggio effettuato con successo");

                    } else {

                        $this->keep('success', "Un errore ha impedito il salvataggio");

                    }

                }

            } else {

                $this->keep('danger', "Dati mancanti completare e riprovare");

            }

            $this->router->switchAction('admin/user');
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
        if ($this->loadUser()->isSuperAdmin()) {

            $this->view->renderArgs('users', $this->userServices->listUsers());

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

    public function update(ServerRequestInterface $serverRequest)
    {

        $id = filter_var($serverRequest->getQueryParams()['id'], FILTER_SANITIZE_NUMBER_INT);

        // todo block edit of sa

        $user = new User();
        $this->controlHeader->save = "#";

        $this->view->renderArgs("states", $user->getStates());

        $this->view->renderArgs('controlHeader', $this->controlHeader);
        $this->view->renderArgs('rolesList', $this->userRoleServices->getRoles());

        $this->view->renderArgs('user', $user->findById($id));

        $this->view->render("/admin/user/new");
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