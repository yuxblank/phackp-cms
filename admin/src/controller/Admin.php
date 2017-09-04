<?php

namespace cms\controller;


use cms\doctrine\repository\UserRepository;
use cms\model\Banner;
use cms\model\Category;
use cms\model\Item;
use cms\model\User;
use cms\model\UserRole;
use cms\overrides\View;
use Psr\Http\Message\ServerRequestInterface;
use SitemapPHP\Sitemap;
use yuxblank\phackp\core\Application;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\routing\api\Router;


/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */


/**
 * Description of Admin
 *
 * @author yuri.blanc
 */
class Admin extends Secured

{
    protected $controlHeader;

    private $menu;

    private $states = array(0 => "Non attivo", 1 => "Pubblicato");

    

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


    public function buildMenu()

    {
        $this->menu = json_decode(file_get_contents(Application::$ROOT . '/config/menu.json'));
        if ($this->menu == null) {
            die('unable to load menu');
        }
        $this->view->renderArgs('userRole', $this->loadUser()->getRole());
        $this->view->renderArgs('adminMenu', $this->menu);
    }


    public function index(ServerRequestInterface $request, User $user, UserRole $userRole, Banner $banner, Category $category, Item $item)

    {
        if (Secured::loadUser()->isCustomer()) {
            $this->router->switchAction('clienti');
        }
        $this->view->renderArgs("item", $item);
        $this->view->renderArgs("category", $category);
        $this->view->renderArgs("user", $user);
        $this->view->renderArgs("userActive", $this->userRepository->count(true));
        $this->view->renderArgs("userTotal", $this->userRepository->count(true));
        /*        $this->view->renderArgs("userRole", $userRole);*/
        $this->view->renderArgs("banner", $banner);
        $this->view->render("/admin/home");
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
        $view = new View();
        $banner = new Banner();
        $view->renderArgs("banners", $banner->findAll("user_id=?", [Secured::loadUser()->id]));
        $view->render("admin/customer");
    }
}

