<?php
namespace controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use cms\model\Banner;
use cms\model\Category;
use cms\model\Item;
use yuxblank\phackp\core\Application;
use yuxblank\phackp\core\Controller;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;
use yuxblank\phackp\view\View;

/**
 * Description of App
 *
 * @author yuri.blanc
 */
class App extends Controller {

    /**
     * @Inject ("app.globals")
     *
     */
    private $globals;
    protected $view;
    protected $router;
    protected $session;

    public function __construct(View $view, Router $router, Session $session)
    {
        parent::__construct();
        $this->view = $view;
        $this->router = $router;
        $this->session = $session;

    }


    /**
     * This method will run before any other method and right after constructor.
     * @return void
     */
    public function onBefore()
    {

        /*if (Application::getConfig()['OFFLINE']) {
            Router::switchAction('offline');
        }*/
        $this->view->renderArgs("GACode", "UA-74399266-1");
        $this->buildMenu();
        $this->getInformazioni('informazioni');
    }

    /**
     * This method will run at last.
     * @return void
     */
    public function onAfter()
    {
        // TODO: Implement onAfter() method.
    }


    public function index () {
        $Item = new Item();
        $this->view->renderArgs("notizie",$Item->findAll("WHERE category_id=? AND status = 1 ORDER BY date_created LIMIT 0,3", 1));
        $this->view->renderArgs("pageItem", $Item->find("WHERE id = ?", 3));

        $directory = Application::$ROOT .'/public/images/home_slider/';
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        $imgList = array();

        foreach ($scanned_directory as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) == (".jpg" || ".png" || ".jpeg")) {
                array_push($imgList, $file);
            }
        }

        $viewRoot = Application::$ROOT . $this->view->getConfig()['ROOT'];

        $this->view->renderArgs("slideshow", $viewRoot."/modules/slideshow.php");
        $this->view->renderArgs("slideshowImages", $imgList);
        $Banner = new Banner();
        $this->view->renderArgs("banners", $Banner->findAll("WHERE status =?", 1));

        $this->view->renderArgs("bannersBox", $viewRoot."/modules/banner_box.php");
        $this->view->render("app/home");
    }

    public function buildMenu() {
        $Category = new Category();
        $this->view->renderArgs("menu",$Category->findAll());
    }


    public function page($params) {

    }

    public function bannerClick($params) {
        $Banner = new Banner();
        $id = filter_var($params['id'],FILTER_SANITIZE_NUMBER_INT);
        $Banner = $Banner->findById($id);
        $Banner->clicks++;
        $Banner->update();

        // TODO auto provide HTTP for external links
        $this->router->redirect("http://".$Banner->url);
    }

    public function novita() {

        $Category = new Category();
        $this->view->renderArgs("category", $Category->find("WHERE title LIKE ?", "Novit%"));

        $this->view->render("app/novita");

    }

    public function showNovita(ServerRequestInterface $request) {

        $id = filter_var($request->getPathParams()['id'],FILTER_SANITIZE_NUMBER_INT);
        $Item = new Item();
        $Item = $Item->findById($id);
        if ($Item) {
            $this->view->renderArgs("item",$Item);
            $this->view->renderArgs("meta_title", $Item->title);
            $this->view->renderArgs("meta_description", $Item->meta_desc);
            $this->view->renderArgs("meta_tags", $Item->meta_tags);
            $this->view->render("app/show_novita");
        } else {
            $this->router->switchAction(404);
        }

    }

    private function getInformazioni($informazioni) {
        $cat = new Category();
        /**
         * @var Category
         */
        $cat = $cat->find("WHERE title LIKE ?", $informazioni);

        if ($cat) {
            /**
             * @var Item
             */
            $items = [];
            foreach ($cat->item() as $item) {
                if ($item->status==1){
                    $items[] = $item;
                }
            }
            $this->view->renderArgs('informazioni', $items);
        }
    }

    public function showPage($params) {
        $id =  filter_var($params['id'],FILTER_SANITIZE_NUMBER_INT);
        $Item = new Item();
        $Item = $Item->findById($id);
        if ($Item && $Item->status == 1) {
            $this->view->renderArgs("item",$Item);
            $this->view->renderArgs("meta_title", $Item->title);
            $this->view->renderArgs("meta_description", $Item->meta_desc);
            $this->view->renderArgs("meta_tags", $Item->meta_tags);
            $this->view->render("app/show_page");
        } else {
            $this->router->switchAction("Errors@404");
        }

    }

    public function pizze(){
        $this->view->renderArgs("meta_title", 'Pizza La Chance - Il nostro menù');
        $this->view->renderArgs("meta_description", 'Visualizza in nostro menù online, ordina in comodità!');
        $this->view->renderArgs("meta_tags",'menu elpaso,menu pizzeria la chance, menu pizza millegusti, menu pizzeria plan felinaz');
        $this->view->render("app/pizze");
    }

    public function doveTrovarci(){
        $this->view->renderArgs("meta_title", 'Pizza La Chance - Dove trovarci');
        $this->view->renderArgs("meta_description", 'Scopri come raggiungerci');
        $this->view->renderArgs("meta_tags",'mappa pizzeria aosta, pizzeria in aosta, pizzeria');
        $this->view->render("app/dove_trovarci");
    }

    public function chiSiamo(){
        $Item = new Item();
        $this->view->renderArgs("meta_title", 'Pizza La Chance - Chi Siamo');
        $this->view->renderArgs("meta_description", 'Informazioni su di noi');
        $this->view->renderArgs("meta_tags",'pizzeria la chance gressan, pizzeria charvensod, pizza asporto charvensod');
        $this->view->renderArgs("pageItem", $Item->findById(6));
        $this->view->render("app/chi_siamo");
    }
    
}
