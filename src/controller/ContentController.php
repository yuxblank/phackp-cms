<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 20:55
 */

namespace cms\controller;

use cms\doctrine\model\Article;
use cms\doctrine\repository\ArticleCategoryRepository;
use cms\doctrine\repository\ArticleRepository;
use cms\doctrine\repository\UserRepository;
use cms\library\crud\CrudController;
use cms\library\crud\Response;
use cms\library\StringUtils;
use cms\model\ContentFactory;
use cms\overrides\View;
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
     * @param ServerRequestInterface $serverRequest
     * @return \Zend\Diactoros\Response\JsonResponse
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function create(ServerRequestInterface $serverRequest)
    {
        $article = ContentFactory::ArticleFactory(new Article(), $serverRequest->getParsedBody(), $this->loadUser());
        // check authorization todo ACL
        $categories = new ArrayCollection();
        foreach ($article->getCategories() as $category) {
            $categories->add($this->articleCategoryRepository->find($category->getId()));
        }
        $article->setCategories($categories);
        /*            if ($user->isAuthorized($ItemLoad->find($article->getId())->user()->role)) {*/
        // do update

        $this->articleRepository->save($article);

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
                return Response::error(400)->build();
            }
        } else {
            return Response::ok($this->articleRepository->findAll())->build();
        }

    }

    public function update(ServerRequestInterface $serverRequest)
    {
        $article = ContentFactory::ArticleFactory(
            $this->articleRepository->find($serverRequest->getParsedBody()['id']),
            $serverRequest->getParsedBody(), $this->loadUser()
        );

        if ($article->getId()=== null){
            return Response::error(400, "Article does not exist")->build();
        }
        if($article->getCategories() === null) {
            return Response::error(400, "No category has been choosen for the article")->build();
        }


        $articleCats = new ArrayCollection();
        foreach ($article->getCategories() as $category){
            $articleCats->add($this->articleCategoryRepository->findOneBy(['id' => $category->getId()]));
        }
        $article->setCategories($articleCats);

       $article = $this->articleRepository->update($article);

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

}