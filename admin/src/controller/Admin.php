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
class Admin extends Controller

{
    protected $view;
    protected $session;
    /** @var  \yuxblank\phackp\routing\Router */
    protected $router;
    /** @var UserRepository */
    protected $userRepository;

    const USER_MIN_LEVEL = 1;

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
            $this->keep("success", "Devi prima autenticarti");
            $this->router->switchAction("admin/login");
        }
        $this->buildMenu();
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
    {     $this->router->switchAction("admin/login");
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
        if ($email !== null && $password !== null && $this->userRepository->authenticateUser($email, $password, self::USER_MIN_LEVEL)) {
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
    public function loadUser()
    {
        $user = $this->session->getValue("user");
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
        $this->view->renderArgs('userRole', $this->loadUser()->getRole());
        $this->view->renderArgs('adminMenu', $this->menu);
    }


    public function config()

    {
        $this->noCustomers();
        $this->view->render("/admin/appconfig");
    }


    public function generateSitmap()
    {

        $this->noCustomers();
        if (file_exists(Application::$ROOT . '/sitemap.xml')) {
            unlink(Application::$ROOT . '/sitemap.xml');
        }
        if (file_exists(Application::$ROOT . '/sitemap-index.xml')) {
            unlink(Application::$ROOT . '/sitemap-index.xml');
        }
        $Sitemap = new Sitemap("");
        $Sitemap->setPath(Application::$ROOT . '/');
        $Sitemap->addItem(rtrim($this->router->link('/'), '/'), 1.0, 'monthly');
        $Sitemap->addItem($this->router->link('novita'), 1.0, 'monthly');
        $Sitemap->addItem($this->router->link('pizze'), 1.0, 'monthly');
        $Sitemap->addItem($this->router->link('dove_trovarci'), 1.0, 'monthly');
        $Sitemap->addItem($this->router->link('chi_siamo'), 1.0, 'monthly');
        $Category = new Category();
        $Categories = $Category->find("title LIKE ?", array("Novit%"));

        foreach ($Categories->item() as $item) {

            if ($item->status == 1) {
                $Sitemap->addItem($this->router->link('novita/{title}/{id}', [$item->alias, $item->id]), 1.0, 'daily');
            }
        }

        $Informations = $Category->find("title LIKE ?", array("Informazioni%"));

        foreach ($Informations->item() as $info) {

            if ($info->status == 1) {
                $Sitemap->addItem($this->router->link('informazioni/{title}/
                {id}', [$info->alias, $info->id]), 1.0, 'monthly');
            }
        }
        $Sitemap->createSitemapIndex(Application::getAppUrl() . "/", 'Today');
        echo "Generazione completata con successo";
    }

    public function onlySuperAdmin()
    {
        if (!Secured::loadUser()->isSuperAdmin()) {
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

