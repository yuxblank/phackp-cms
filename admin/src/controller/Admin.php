<?php

namespace cms\controller;


use cms\doctrine\repository\UserRepository;
use cms\model\Banner;
use cms\model\Category;
use cms\overrides\View;
use SitemapPHP\Sitemap;
use yuxblank\phackp\core\Application;
use yuxblank\phackp\core\Controller;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Description of Admin
 *
 * @author yuri.blanc
 */
abstract
class Admin extends Controller

{
    const USER_MIN_LEVEL = 1;


    protected $view;
    protected $session;
    /** @var  \yuxblank\phackp\routing\Router */
    protected $router;
    /** @var UserRepository */
    protected $userRepository;
    protected $controlHeader;
    private $menu;
    protected $states = array(0 => "Non attivo", 1 => "Pubblicato");
    /**
     * Admin constructor.
     * @param View $view
     * @param Session $session
     * @param Router $router
     * @param UserRepository $userRepository
     * @internal param EntityManagerInterface $entityManager
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
        $this->controlHeader = new \stdClass();
        if ($this->loadUser() === null) {
            $this->keep('success', 'Devi prima autenticarti');
            exit($this->router->switchAction('admin/login'));
        }
        $this->buildMenu();
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
        $user = $this->session->getValue('user');
        if ($user) {
            return $this->userRepository->findUser($user);
        }
    }


    public function buildMenu()

    {
        $this->menu = json_decode(file_get_contents(Application::$ROOT . '/config/menu.json'));
        if ($this->menu == null) {
            die('unable to load menu');
        }
        $this->view->renderArgs('userRole', $this->loadUser()->getRoles());
        $this->view->renderArgs('adminMenu', $this->menu);
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

    public function customers()
    {
        $banner = new Banner();
        $this->view->renderArgs("banners", $banner->findAll("user_id=?", [$this->loadUser()->getId()]));
        $this->view->render("admin/customer");
    }
}

