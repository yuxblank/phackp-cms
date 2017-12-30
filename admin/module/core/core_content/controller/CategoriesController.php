<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 21:16
 */
namespace core\core_content\controller;


use cms\doctrine\repository\UserRepository;
use cms\library\StringUtils;
use cms\overrides\View;
use core\core_content\database\repository\ArticleCategoryRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;
use Zend\Diactoros\Response\JsonResponse;

class CategoriesController extends BaseCategoryController
{

    /**
     * CategoriesController constructor.
     * @param View $view
     * @param Session $session
     * @param Router $router
     * @param StringUtils $stringUtils
     * @param UserRepository $userRepository
     * @param \core\core_content\controller\ArticleCategoryRepository $articleCategoryRepository
     */
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
        } else {
            $this->controlHeader->save = "#";
            $this->view->renderArgs("controlHeader", $this->controlHeader);
            $this->view->render('/admin/content/newCategory');
        }

    }

    public function read(ServerRequestInterface $serverRequest)
    {

        $result = parent::read($serverRequest);

        if ($result->offsetExists('article.category')){
            $this->view->renderArgs("category", $result->offsetGet('article.category'));
            $this->controlHeader->save = "#";
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->render("/admin/content/newCategory");
        } else if ($result->offsetExists('article.categories')){
            $this->controlHeader->new = $this->router->link('admin/category/new');
            $this->controlHeader->delete = true;
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->renderArgs('categories', $result->offsetGet('article.categories'));
            $this->view->render("/admin/content/categories");
        } else {
            $this->keep("warning", "Nessun elemento trovato");
        }
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        $result = null;
        try {
            $result = parent::update($serverRequest);
            if ($result->offsetExists('article.category')){
                $this->router->_switchAction('category.list');
            }
        } catch (OptimisticLockException $e) {

        }
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        return new JsonResponse(['result' => parent::delete($serverRequest)->offsetGet('users.removed')]);
    }


}