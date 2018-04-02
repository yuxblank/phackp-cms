<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 23/09/2017
 * Time: 15:15
 */

namespace cms\controller;



use cms\controller\Admin;
use cms\doctrine\model\ArticleCategory;
use cms\doctrine\repository\ArticleCategoryRepository;
use cms\doctrine\repository\UserRepository;
use cms\library\crud\CrudResult;
use cms\library\StringUtils;
use cms\overrides\View;
use League\OAuth2\Server\ResourceServer;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

abstract class BaseCategoryController extends Admin

{

    protected $articleCategoryRepository;
    protected $stringUtils;

    public function __construct(Router $router, StringUtils $stringUtils, UserRepository $userRepository, ResourceServer $resourceServer, ArticleCategoryRepository $articleCategoryRepository, ServerRequestInterface $serverRequest)
    {
        parent::__construct($router, $userRepository, $resourceServer, $serverRequest);
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
        if ($serverRequest->getMethod() === 'POST') {
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
        }
        return $crudResult;

    }

    /**
     * @param ServerRequestInterface $serverRequest
     * @return CrudResult
     */
    public function read(ServerRequestInterface $serverRequest)
    {
        $crudResult = new CrudResult();
        $id = $serverRequest->getPathParams() ? filter_var($serverRequest->getPathParams()['id'], FILTER_SANITIZE_NUMBER_INT) : null;
        if ($id) {
            $cat = $this->articleCategoryRepository->find($id);
            $crudResult->offsetSet('article.category', $cat);
        } else {
            if (!$serverRequest->getQueryParams()) {
                $crudResult->offsetSet('article.categories', $this->articleCategoryRepository->findAll());
            }
            else {
                $crudResult->offsetSet('article.categories', $this->articleCategoryRepository->findBy($serverRequest->getQueryParams()));
            }
        }
        return $crudResult;
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
        $id = (int) $serverRequest->getPathParams()['id'];
        $category = $this->articleCategoryRepository->find($id);
        $crudResult->offsetSet('removed.categories', $this->articleCategoryRepository->delete($category));

        return $crudResult;
    }


}