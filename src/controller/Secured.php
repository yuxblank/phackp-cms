<?php
namespace controller;

use model\User;
use yuxblank\phackp\core\Controller;
use yuxblank\phackp\core\Crypto;
use yuxblank\phackp\core\Logger;
use yuxblank\phackp\core\Router;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\core\View;

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

     public function authenticate($params) {
       $email = filter_var($params['email'],FILTER_SANITIZE_EMAIL);
       $password = filter_var($params['password'],FILTER_SANITIZE_STRING);
       if ($email!== null && $password!== null) {
           // check user
           $User = new User();
           $User = $User->find("WHERE email = ?",$email);
           /*echo $password;*/
           $crypto = new Crypto();
           if ($User && ($crypto->generateHash($password) === $User->password)) {
               if ($User->role<1) {
                   die("Accesso non autorizzato");
               }

               Logger::info('User '. $email . ' has been logged in');

               $this->session->setValue("user", $User);
               self::keep('success', "Autenticazione avvenuta con successo!");
               echo "true";
           } else {
           echo "I dati di accesso inseriti non sono corretti!";
           }
       }


    }

    /**
     * @return null|User|User
     */
    public  function loadUser() {
        return $this->session->getValue("user");
    }



}

