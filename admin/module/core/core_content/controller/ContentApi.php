<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 24/02/18
 * Time: 14.41
 */

namespace cms\module\core\core_content\controller;


use cms\controller\PublicApi;
use cms\library\crud\Response;
use core\core_content\database\repository\ArticleCategoryRepository;
use core\core_content\database\repository\ArticleRepository;
use Doctrine\ORM\NoResultException;
use yuxblank\phackp\http\api\ServerRequestInterface;

class ContentApi extends PublicApi
{

    protected $articleCategoryRepository;
    protected $articleRepository;

    /**
     * ContentApi constructor.
     * @param ServerRequestInterface $serverRequest
     * @param ArticleCategoryRepository $articleCategoryRepository
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ServerRequestInterface $serverRequest, ArticleCategoryRepository $articleCategoryRepository, ArticleRepository $articleRepository)
    {
        parent::__construct($serverRequest);
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    public function getCategories() {
        $categories = [];
        try {
            if (!$this->serverRequest->getQueryParams()) {
                $categories = $this->articleCategoryRepository->findAll();
            } else {
                $pagination = $this->parsePagination();
                $categories = $this->articleCategoryRepository->getCategoriesFrom($pagination['from'], $pagination['max']);
            }
        } catch (NoResultException $ex){
            return Response::error(503)->build();
        }

        return Response::ok($categories)->build();
    }

    public function getArticles(){
        $articles = [];
        try {
            if (!$this->serverRequest->getPathParams()) {
                $articles = $this->articleRepository->findAll();
            } else {
                $pagination = $this->parsePagination();
                $articles = $this->articleRepository->getArticlesFrom($pagination['from'], $pagination['max']);
            }
        } catch (NoResultException $exception) {
            return Response::error(503)->build();
        }

        return Response::ok($articles)->build();
    }


    private function parsePagination() : array {
        $max = (int)filter_var($this->serverRequest->getQueryParams()['results'], FILTER_SANITIZE_NUMBER_INT);
        $from = (int)filter_var($this->serverRequest->getQueryParams()['page'], FILTER_SANITIZE_NUMBER_INT);
        return  ['from' => --$from, 'max' => --$max];
    }

}