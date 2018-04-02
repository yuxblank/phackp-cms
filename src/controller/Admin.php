<?php

namespace cms\controller;


use cms\doctrine\repository\UserRepository;
use cms\library\crud\Response;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use yuxblank\phackp\core\Controller;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

/**
 * Description of Admin
 *
 * @author yuri.blanc
 */
abstract class Admin extends Controller

{
    const USER_MIN_LEVEL = 1;


    protected $session;
    protected $server;
    protected $serverRequest;
    /** @var  \yuxblank\phackp\routing\Router */
    protected $router;
    /** @var UserRepository */
    protected $userRepository;
    protected $controlHeader;
    private $menu;
    protected $states = array(0 => "Non attivo", 1 => "Pubblicato");


    public function __construct(Router $router, UserRepository $userRepository,ResourceServer $resourceServer, ServerRequestInterface $serverRequest)
    {
        parent::__construct();
        $this->serverRequest = $serverRequest;
        $this->server = $resourceServer;
        $this->router = $router;
        $this->userRepository = $userRepository;
    }



    public function onBefore()
    {
        try {
            $this->serverRequest = $this->server->validateAuthenticatedRequest($this->serverRequest);
        } catch (OAuthServerException $e) {
             return Response::error(401, "Not authorized!")->build();
        }
    }

    public function onAfter()
    {
        // TODO: Implement onAfter() method.
    }


    /**
     * @return \cms\doctrine\model\User
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function loadUser()
    {
        $user = $this->serverRequest->getAttribute("oauth_user_id");
        if ($user) {
            return $this->userRepository->find($user);
        }
    }



    public function onlySuperAdmin()
    {
        if (!$this->loadUser()->isSuperUser()) {
            die("unathorized access");
        }
    }

    public function noCustomers()
    {
        if ($this->loadUser()->isCustomer()) {
            die("unathorized access");
        }
    }
}

