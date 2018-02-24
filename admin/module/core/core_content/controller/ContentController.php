<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 20:55
 */

namespace core\core_content\controller;

use cms\controller\Admin;
use cms\doctrine\repository\UserRepository;
use cms\library\crud\CrudController;
use cms\library\crud\Response;
use cms\library\StringUtils;
use cms\overrides\View;
use core\core_content\database\entity\Article;
use core\core_content\database\repository\ArticleCategoryRepository;
use core\core_content\database\repository\ArticleRepository;
use DI\Annotation\Inject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Persisters\PersisterException;
use League\OAuth2\Server\ResourceServer;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;

class ContentController extends Admin implements CrudController
{

    /**
     * @Inject
     * @var  StringUtils
     */
    private $stringUtils;
    /** @var  ArticleRepository */
    protected $articleRepository;

    /** @var  ArticleCategoryRepository */
    protected $articleCategoryRepository;

    /**
     * ContentController constructor.
     * @param View $view
     * @param Session $session
     * @param Router $router
     * @param UserRepository $userRepository
     * @param ArticleRepository $articleRepository
     * @param ArticleCategoryRepository $articleCategoryRepository
     * @param StringUtils $stringUtils
     */
    public function __construct(View $view, Session $session, Router $router, UserRepository $userRepository, ArticleRepository $articleRepository, ArticleCategoryRepository $articleCategoryRepository, StringUtils $stringUtils, ResourceServer $server, ServerRequestInterface $serverRequest)
    {
        parent::__construct($view, $session, $router, $userRepository, $server, $serverRequest);
        $this->stringUtils = $stringUtils;
        $this->articleRepository = $articleRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
    }


    /**
     * Todo refactor to use update instead of create
     * @param ServerRequestInterface $serverRequest
     * @throws \Doctrine\ORM\Persisters\PersisterException
     */
    public function create(ServerRequestInterface $serverRequest)
    {
        $article = $this->parseContentRequest($serverRequest);
        // check authorization todo ACL
        /*            if ($user->isAuthorized($ItemLoad->find($article->getId())->user()->role)) {*/
        $article->date_edit = new \DateTime();
        // do update
        try {
            $this->articleRepository->save($article);
        } catch (PersisterException $exception) {
            return Response::error(503, $exception->getTrace())->build();
        } catch (OptimisticLockException $e) {
            return Response::error(503, $e->getTrace())->build();
        }
        return Response::ok($article)->build();
    }

    public
    function read(ServerRequestInterface $serverRequest)
    {
        $id = $serverRequest->getPathParams() ? filter_var($serverRequest->getPathParams()['id'], FILTER_SANITIZE_NUMBER_INT) : null;
        if ($id) {
            $article = $this->articleRepository->find($id);
            if ($article) {
                return Response::ok($article)->build();
            } else {
                return Response::error(503)->build();
            }
        } else {
            return Response::ok($this->articleRepository->findAll())->build();
        }

    }

    public
    function update(ServerRequestInterface $serverRequest)
    {
        $article = $this->parseContentRequest($serverRequest);
        if ($article->getId() !== null && ($article->getTitle() !== null && $article->getContent() !== null && $article->getStatus() !== null && $article->getCategories() !== null)) {
            // check authorization todo ACL
            /*            if ($user->isAuthorized($ItemLoad->find($article->getId())->user()->role)) {*/
            $article->date_edit = new \DateTime();
            // do update
            try {
                $this->articleRepository->update($article);
            } catch (PersisterException $exception) {
                return Response::error(503)->build();
            } catch (OptimisticLockException $e) {
                return Response::error(503)->build();
            }

        }
        return Response::ok($article)->build();
    }

    public
    function delete(ServerRequestInterface $serverRequest)
    {
        if ($serverRequest->getPathParams()) {
            try {
                $articleId = (int)$serverRequest->getPathParams()['id'];
                $article = $this->articleRepository->find($articleId);
                $this->articleRepository->delete($article);
            } catch (PersisterException $exception) {
                return Response::error(503, $exception)->build();
            }
        }
        return Response::ok()->build();
    }


    protected function parseContentRequest(ServerRequestInterface $serverRequest): Article
    {

        $article = new Article();

        if ($serverRequest->getParsedBody()['id'] !== null && $serverRequest->getParsedBody()['id'] !== '') {
            $id = filter_var($serverRequest->getParsedBody()['id'], FILTER_SANITIZE_NUMBER_INT);
            $article = $this->articleRepository->find($id);
        }

        $article->setTitle(strip_tags(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING)));
        $article->setContent(htmlspecialchars($serverRequest->getParsedBody()['content']));
        $article->setStatus((int)$serverRequest->getParsedBody()['status']);


        $categories = $serverRequest->getParsedBody()['categories'];
/*        $category = $this->articleCategoryRepository->find($categoryId['id']);*/

        $fetchedCats= new ArrayCollection();
        foreach ($categories as $category){
            $fetchedCats->add($this->articleCategoryRepository->find($category['id']));
        }


        $article->setCategories($fetchedCats);

        $article->setMetaDesc(strip_tags($serverRequest->getParsedBody()['meta_description']));
        $article->setMetaTags(strip_tags($serverRequest->getParsedBody()['meta_tags']));
        $article->setMetaTitle($article->getTitle());
        $article->setUser($this->loadUser());
        $article->setAlias($this->stringUtils->toAscii(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING)));
        return $article;
    }


}