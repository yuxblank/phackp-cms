<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 23/09/2017
 * Time: 15:15
 */

namespace cms\controller;


use cms\doctrine\model\ArticleCategory;
use cms\doctrine\repository\ArticleCategoryRepository;
use cms\doctrine\repository\UserRepository;
use cms\library\crud\CrudController;
use cms\library\crud\CrudResult;
use cms\library\StringUtils;
use cms\overrides\View;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

abstract class BaseCategoryController extends Admin

{

    protected $articleCategoryRepository;
    protected $stringUtils;

    public function __construct(View $view, Session $session, Router $router, StringUtils $stringUtils, UserRepository $userRepository, ArticleCategoryRepository $articleCategoryRepository)
    {
        parent::__construct($view, $session, $router, $userRepository);
        $this->stringUtils = $stringUtils;
        $this->articleCategoryRepository = $articleCategoryRepository;
    }


    /**
     * @param ServerRequestInterface $serverRequest
     * @return CrudResult
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    public function create(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();
        $category = new ArticleCategory();
        $title = strip_tags($serverRequest->getParsedBody()['title']);
        $description = strip_tags($serverRequest->getParsedBody()['description']);
        $meta_desc = htmlspecialchars($serverRequest->getParsedBody()['meta_description']);
        $meta_tags = strip_tags($serverRequest->getParsedBody()['meta_tags']);

        $category->setContent($description);
        $category->setTitle($title);
        /*      $category->meta_description = $meta_desc;*/
        $category->setMetaTags($meta_tags);
        $category->setAlias($this->stringUtils->toAscii(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING)));
        $category = $this->articleCategoryRepository->save($category);
        $crudResult->offsetSet('article.category', $category);
        return $crudResult;

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

    /**
     * @param ServerRequestInterface $serverRequest
     * @return CrudResult
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    public function update(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();

        $id = filter_var($serverRequest->getParsedBody()['id'], FILTER_SANITIZE_NUMBER_INT);
        $title = strip_tags($serverRequest->getParsedBody()['title']);
        $description = strip_tags($serverRequest->getParsedBody()['description']);
        $meta_desc = htmlspecialchars($serverRequest->getParsedBody()['meta_description']);
        $meta_tags = strip_tags($serverRequest->getParsedBody()['meta_tags']);

        /** @var ArticleCategory $category */
        $category = $this->articleCategoryRepository->find($id);

        $category->setContent($description);
        $category->setTitle($title);
        /*      $category->meta_description = $meta_desc;*/
        $category->setMetaTags($meta_tags);
        $category->setAlias($this->stringUtils->toAscii(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING)));

        $category = $this->articleCategoryRepository->update($category);
        $crudResult->offsetSet('article.category', $category);
        return $crudResult;
    }

    /**
     * @param ServerRequestInterface $serverRequest
     * @return CrudResult
     */
    public function delete(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();
        $ids = $serverRequest->getQueryParams()['ids'];
        if ($ids !== null && count($ids) > 0) {
            $crudResult->offsetSet('removed.categories', $this->articleCategoryRepository->deleteArticles($ids));
        }
        return $crudResult;
    }


}