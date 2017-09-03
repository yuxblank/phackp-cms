<?php
namespace cms\controller;

use cms\model\User;
use cms\overrides\View;
use Psr\Http\Message\ServerRequestInterface;
use yuxblank\phackp\core\Controller;
use yuxblank\phackp\core\Crypto;
use yuxblank\phackp\core\Logger;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\routing\api\Router;

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
class Secured extends Controller {

    protected $view;
    protected $session;
    protected $router;

    /**
     * Secured constructor.
     * @param View $view
     * @param Session $session
     * @param Router $router
     */
    public function __construct(View $view, Session $session, Router $router)
    {
        parent::__construct();
        $this->view = $view;
        $this->session = $session;
        $this->router = $router;
    }

    public function onBefore()
    {
        // TODO: Implement onBefore() method.
    }

    public function onAfter()
    {
        // TODO: Implement onAfter() method.
    }




    public function login() {
        if($this->session->getValue('user')!==null) {
            self::keep("warning", "Sei già autenticato");
        }
        $this->view->render("/admin/login");

    }
    
    public function logout() {
        if(Session::_getValue("user")!==null) {
            Session::_stop();
            self::keep("success", "Ti sei disconnesso correttamente");
            Router::switchAction('admin/login');
        } else {
            self::keep("danger", "Non sei connesso");
            Router::switchAction('admin/login');
        }
    }

     public function authenticate(ServerRequestInterface $serverRequest) {
       $email = filter_var($serverRequest->getParsedBody()['email'],FILTER_SANITIZE_EMAIL);
       $password = filter_var($serverRequest->getParsedBody()['password'],FILTER_SANITIZE_STRING);
       if ($email!== null && $password!== null) {
           // check user
           $User = new User();
           /**
            * @var User
            */
           $User = $User->find("WHERE email = ?",$email);
           /*echo $password;*/
           $crypto = new Crypto();
           if ($User && ($crypto->generateHash($password) === $User->password)) {
               if (!$User->role() || $User->role()->level<1) {
                   die("Accesso non autorizzato");
               }

               //Logger::info('User '. $email . ' has been logged in');

               $this->session->setValue("user", $User);
               self::keep('success', "Autenticazione avvenuta con successo!");
               echo "true";
           } else {
           echo "I dati di accesso inseriti non sono corretti!";
           }
       }


    }

    /**
     * @return User
     */
    public  function loadUser()
    {
        return $this->session->getValue("user");
    }



}

