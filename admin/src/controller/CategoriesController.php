<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 21:16
 */

namespace cms\controller;


use cms\doctrine\repository\UserRepository;
use cms\library\crud\CrudController;
use cms\library\StringUtils;
use cms\model\Category;
use cms\overrides\View;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

class CategoriesController extends Admin implements CrudController
{
    private $stringUtils;

    public function __construct(View $view, Session $session, Router $router, StringUtils $stringUtils, UserRepository $userRepository)
    {
        parent::__construct($view,$session,$router,$userRepository);
        $this->stringUtils = $stringUtils;
    }


    /**
     * Todo refactor to use update
     * @param ServerRequestInterface $serverRequest
     */

    public function create(ServerRequestInterface $serverRequest)
    {

        $id = $serverRequest->getParsedBody()['id'];
        $title = strip_tags($serverRequest->getParsedBody()['title']);
        $description = strip_tags($serverRequest->getParsedBody()['description']);
        $meta_desc = htmlspecialchars($serverRequest->getParsedBody()['meta_description']);
        $meta_tags = strip_tags($serverRequest->getParsedBody()['meta_tags']);
        $Category = new Category();
        $Category->id = $id;
        $Category->description = $description;
        $Category->title = $title;
        $Category->meta_description = $meta_desc;
        $Category->meta_tags = $meta_tags;
        $Category->alias = $this->stringUtils->toAscii(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING));


        if ($Category->id !== null && $Category->id !== '' && $Category->title !== '') {

            if ($Category->update()) {

                $this->keep('success', "Aggiornamento effettuato con successo");

                $this->router->switchAction('admin/categories');

            } else {

                $this->keep('danger', "Un errore ha impedito il salvataggio");

                $this->router->switchAction('admin/category/edit/' . $id);

            }


        } else if (isset($id) && $id == '' && $title != '') {

            $Category->id = null;
            if ($Category->save()) {

                $this->keep('success', "Salvataggio effettuato con successo");

                $this->router->switchAction('admin/categories');

            } else {

                $this->keep('danger', "Un errore ha impedito il salvataggio");

                $this->router->switchAction('admin/category/edit/' . $id);


            }


        } else {

            $this->keep('danger', "Dati mancanti completare e riprovare");

            $this->router->switchAction('admin/category/edit/' . $id);

        }
    }

    public function read(ServerRequestInterface $serverRequest)
    {
        $Category = new Category();

        $id = $serverRequest->getPathParams() ? filter_var($serverRequest->getPathParams()['id'], FILTER_SANITIZE_NUMBER_INT) : null;
        if ($id){
            $cat = $Category->findById($id);
            if ($Category) {
                $this->view->renderArgs("category", $cat);
            } else {
                $this->keep("warning", "Nessun elemento trovato");
            }
            $this->controlHeader->save = "#";
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->render("/admin/content/newCategory");
        } else {
            $this->controlHeader->new = $this->router->link('admin/category/new');
            $this->controlHeader->delete = true;
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->renderArgs('categories', $Category->findAll());
            $this->view->render("/admin/content/categories");
        }
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement update() method.
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        $ids = $serverRequest->getQueryParams()['ids'];
        $deleted = 0;
        if ($ids !== null && count($ids) > 0) {
            $Category = new Category();
            foreach ($ids as $id) {
                $Category->delete($id);
                $deleted++;
            }

        }
        echo $deleted;
    }


}