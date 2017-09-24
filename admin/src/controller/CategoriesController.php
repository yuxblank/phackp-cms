<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 21:16
 */

namespace cms\controller;


use cms\doctrine\repository\ArticleCategoryRepository;
use cms\doctrine\repository\UserRepository;
use cms\library\StringUtils;
use cms\overrides\View;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;
use Zend\Diactoros\Response\JsonResponse;

class CategoriesController extends BaseCategoryController
{

    public function __construct(View $view, Session $session, Router $router, StringUtils $stringUtils, UserRepository $userRepository, ArticleCategoryRepository $articleCategoryRepository)
    {
        parent::__construct($view, $session, $router, $stringUtils, $userRepository, $articleCategoryRepository);
    }


    public function create(ServerRequestInterface $serverRequest)
    {

        if ($serverRequest->getMethod() === 'POST') {

            try {
                $result = parent::create($serverRequest);
                $this->keep('success', "Salvataggio effettuato con successo");
                $this->router->switchAction('admin/categories');
            } catch (ORMInvalidArgumentException $invalidArgumentException) {
                $this->keep('danger', "Dati mancanti completare e riprovare");
                $this->router->switchAction('admin/category/edit/');
            } catch (ORMException $exception) {
                $this->keep('danger', "Un errore ha impedito il salvataggio");
                $this->router->switchAction('admin/category/edit/');
            }
        }

    }

    public function read(ServerRequestInterface $serverRequest)
    {

        $id = $serverRequest->getPathParams() ? filter_var($serverRequest->getPathParams()['id'], FILTER_SANITIZE_NUMBER_INT) : null;
        if ($id) {
            $cat = $this->articleCategoryRepository->find($id);
            if ($cat) {
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
            $this->view->renderArgs('categories', $this->articleCategoryRepository->findAll());
            $this->view->render("/admin/content/categories");
        }
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement update() method.
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        return new JsonResponse(['result' => parent::delete($serverRequest)->offsetGet('users.removed')]);
    }


}