<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 21/09/2017
 * Time: 13:42
 */

namespace cms\controller;


use cms\doctrine\repository\UserRepository;
use cms\doctrine\repository\UserRoleRepository;
use cms\library\crud\CrudResult;
use cms\overrides\View;
use Doctrine\ORM\Persisters\PersisterException;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

abstract class BaseUserController extends Admin
{
    protected $userRoleRepository;
    protected $userStates = array(0 => 'disabled', 1 => 'active');

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

    /**
     * Return User if the ServerRequest is POST and the user has been stored successfully.
     * @param ServerRequestInterface $serverRequest
     * @return CrudResult|null
     * @throws \Zend\Crypt\Password\Exception\RuntimeException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws PersisterException
     */
    public function create(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();
        if ($serverRequest->getMethod() === 'POST') {
            $email = filter_var($serverRequest->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
            $userrole_id = filter_var($serverRequest->getParsedBody()['role'], FILTER_SANITIZE_NUMBER_INT);

            $password = filter_var($serverRequest->getParsedBody()['password'], FILTER_SANITIZE_STRING);
            $status = filter_var($serverRequest->getParsedBody()['status'], FILTER_SANITIZE_NUMBER_INT);
            try {
                /** @var \cms\doctrine\model\UserRole $userrole */
                $userrole = $this->userRoleRepository->find($userrole_id);
                $user = $this->userRepository->createUser($email, $password, $email, $userrole);
                $crudResult->offsetSet('user', $user);
                return $crudResult;
            } catch (PersisterException $exception) {
                throw new PersisterException($exception);
            }
        }
    }

    /**
     * @param ServerRequestInterface $serverRequest
     * @return CrudResult
     */
    public function read(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();
        if ($serverRequest->getPathParams()) {
            $id = filter_var($serverRequest->getPathParams()['id'], FILTER_SANITIZE_NUMBER_INT);
            $crudResult->offsetSet('rolesList', $this->userRoleRepository->findAll());
            $crudResult->offsetSet('user', $this->userRepository->find($id));
            return $crudResult;
        }

        $crudResult->offsetSet('users', $this->userRepository->findAll());
        $crudResult->offsetSet('rolesList', $this->userRoleRepository->findAll());

        return $crudResult;
    }


    public function update(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();
        $email = filter_var($serverRequest->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $userrole_id = filter_var($serverRequest->getParsedBody()['role'], FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($serverRequest->getParsedBody()['password'], FILTER_SANITIZE_STRING);
        $status = filter_var($serverRequest->getParsedBody()['status'], FILTER_SANITIZE_NUMBER_INT);

        try {
            /** @var \cms\doctrine\model\UserRole $userrole */
            $userrole = $this->userRoleRepository->find($userrole_id);
            $user = $this->userRepository->updateUserDetails($email, $email, $status, $userrole, $password);
            $crudResult->offsetSet('user', $user);
        } catch (PersisterException $exception) {
            throw new PersisterException($exception);
        }

        return $crudResult;
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();
        $ids = $serverRequest->getParsedBody()['ids'];
        if ($ids !== null && count($ids) > 0) {
            $crudResult->offsetSet('removed.users',$this->userRepository->removeUsers($ids));
        }
        return $crudResult;
    }


}