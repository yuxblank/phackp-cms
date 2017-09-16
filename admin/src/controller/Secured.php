<?php

namespace cms\controller;

use cms\doctrine\repository\UserRepository;
use cms\model\User;
use cms\overrides\View;
use Psr\Http\Message\ServerRequestInterface;
use yuxblank\phackp\core\Controller;
use yuxblank\phackp\core\Crypto;
use yuxblank\phackp\core\Logger;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\routing\api\Router;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Stdlib\Response;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Secured
 *
 * @author yuri.blanc
 */
class Secured extends Controller
{

    const USER_MIN_LEVEL = 2;

    protected $view;
    protected $session;
    protected $router;
    /** @var UserRepository */
    protected $userRepository;

    /**
     * Secured constructor.
     * @param View $view
     * @param Session $session
     * @param Router $router
     * @param UserRepository $userRepository
     */
    public function __construct(View $view, Session $session, Router $router, UserRepository $userRepository)
    {
        parent::__construct();
        $this->view = $view;
        $this->session = $session;
        $this->router = $router;
        $this->userRepository = $userRepository;
    }

    public function onBefore()
    {
        // TODO: Implement onBefore() method.
    }

    public function onAfter()
    {
        // TODO: Implement onAfter() method.
    }


    public function login()
    {
        if ($this->session->getValue('user') !== null) {
            $this->keep("warning", "Sei già autenticato");
        }
        $this->view->render("/admin/login");

    }

    public function logout()
    {
        if ($this->session->getValue("user") !== null) {
            $this->session->stop();
            $this->keep("success", "Ti sei disconnesso correttamente");
            $this->router->switchAction('admin/login');
        } else {
            $this->keep("danger", "Non sei connesso");
            $this->router->switchAction('admin/login');
        }
    }

    public function authenticate(ServerRequestInterface $serverRequest)
    {
        $email = filter_var($serverRequest->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($serverRequest->getParsedBody()['password'], FILTER_SANITIZE_STRING);
        if ($email !== null && $password !== null && $this->userRepository->authenticateUser($email, $password, Admin::USER_MIN_LEVEL)) {
            $this->session->setValue('user', $email);
            $this->keep('success', 'Autenticazione avvenuta con successo!');
            return new JsonResponse(['result' => 'ok']);
        }
        return new JsonResponse(['result' => 'Authentication was not successful, please retry.']);
    }

    /**
     * @return \cms\doctrine\model\User
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public
    function loadUser()
    {
        $user = $this->session->getValue("user");
        if ($user) {
            return $this->userRepository->findUser($user);
        }
    }


}

