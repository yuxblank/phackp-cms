<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 20:55
 */

namespace core\core_content\controller;

use Ardent\Collection\Collection;
use cms\controller\Admin;
use cms\doctrine\repository\UserRepository;
use cms\library\crud\CrudController;
use cms\library\crud\Response;
use cms\library\StringUtils;
use cms\model\Item;
use cms\overrides\View;
use core\core_content\database\entity\Article;
use core\core_content\database\entity\ArticleCategory;
use core\core_content\database\repository\ArticleCategoryRepository;
use core\core_content\database\repository\ArticleRepository;
use DI\Annotation\Inject;
use Doctrine\Common\Collections\ArrayCollection;
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
            $this->keep('danger', "Un errore ha impedito il salvataggio");
            $this->router->switchAction('admin/content');
            return Response::error(503)->build();
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
                /*             $this->view->renderArgs("item", $article);*/
                return Response::ok($article)->build();
            } else {
                /*  $this->keep("warning", "Nessun elemento trovato");*/
                return Response::error(503)->build();
            }
            /*   $this->view->renderArgs("categories", $this->articleRepository->getCategories());
               $this->controlHeader->save = "#";
               $this->view->renderArgs("states", $this->states);
               $this->view->renderArgs('controlHeader', $this->controlHeader);
               $this->view->render("/admin/content/new");*/
        } else {
            /*            $user = $this->loadUser();
                        if ($user->isSuperUser()) {*/
            /*        $this->view->renderArgs('articles', $this->articleRepository->findAll());*/
            /* } else if ($this->loadUser()->isAdmin()) {
                 $this->view->renderArgs('items', $this->articleRepository->getUserArticles($user));
             }*/
            /*  $this->controlHeader->new = $this->router->link('admin/content/new');
              $this->controlHeader->delete = true;
              $this->view->renderArgs('controlHeader', $this->controlHeader);
              $this->view->render("/admin/content/index");*/
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
            }

        }
        return Response::ok($article)->build();
    }

    public
    function delete(ServerRequestInterface $serverRequest)
    {
        $User = $this->loadUser();

        $ids = $serverRequest->getQueryParams()['ids'];

        $Item = new item();

        $deleted = 0;

        if ($ids !== null && count($ids) > 0) {


            foreach ($ids as $id) {


                $ItemFind = new Item();

                $ItemFind = $ItemFind->findById($id);


                if ($User->isAuthorized($ItemFind->user()->role)) {

                    $Item->delete($id);

                    $deleted++;

                } else {

                    echo 'Non hai permessi sufficenti per cancellare questo elemento: ' . $ItemFind->title . '<br>';

                }

            }

        }

        echo $deleted;
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
        $article->setStatus($serverRequest->getParsedBody()['status']);


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
/*        $article->setUser($this->loadUser());*/
        $article->setAlias($this->stringUtils->toAscii(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING)));
        return $article;
    }


}