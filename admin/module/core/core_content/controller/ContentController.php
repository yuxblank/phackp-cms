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
use cms\library\StringUtils;
use cms\model\Item;
use cms\overrides\View;
use core\core_content\database\entity\Article;
use core\core_content\database\repository\ArticleCategoryRepository;
use core\core_content\database\repository\ArticleRepository;
use DI\Annotation\Inject;
use Doctrine\ORM\Persisters\PersisterException;
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
    public function __construct(View $view, Session $session, Router $router, UserRepository $userRepository, ArticleRepository $articleRepository, ArticleCategoryRepository $articleCategoryRepository, StringUtils $stringUtils)
    {
        parent::__construct($view, $session, $router, $userRepository);
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
        if ($serverRequest->getMethod() === 'POST') {

            $user = $this->loadUser();

            // model instance

            $article = new Article();

            if ($serverRequest->getParsedBody()['id'] !== null && $serverRequest->getParsedBody()['id'] !== '') {
                $id = filter_var($serverRequest->getParsedBody()['id'], FILTER_SANITIZE_NUMBER_INT);
                $article = $this->articleRepository->find($id);
            }

            $article->setTitle(strip_tags(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING)));
            $article->setContent(htmlspecialchars($serverRequest->getParsedBody()['content']));
            $article->setStatus($serverRequest->getParsedBody()['state']);


            $categoryId = filter_var($serverRequest->getParsedBody()['category'], FILTER_SANITIZE_NUMBER_INT);
            $category = $this->articleCategoryRepository->find($categoryId);
            $article->addCategory($category);

            $article->setMetaDesc(strip_tags($serverRequest->getParsedBody()['meta_description']));
            $article->setMetaTags(strip_tags($serverRequest->getParsedBody()['meta_tags']));
            $article->setMetaTitle($article->getTitle());
            $article->setUser($user);
            $article->setAlias($this->stringUtils->toAscii(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING)));


            if ($article->getId() !== null && ($article->getTitle() !== null && $article->getContent() !== null && $article->getStatus() !== null && $article->getCategories() !== null)) {
                // check authorization todo ACL
                /*            if ($user->isAuthorized($ItemLoad->find($article->getId())->user()->role)) {*/
                $article->date_edit = new \DateTime();
                // do update
                try {
                    $this->articleRepository->update($article);
                } catch (PersisterException $exception) {
                    $this->keep('danger', "Un errore ha impedito il salvataggio");
                    $this->router->switchAction('admin/content');
                    throw new PersisterException($exception);
                }
                $this->keep('success', "Salvataggio effettuato con successo");
                $this->router->switchAction('admin/content');

                /*   } else {
                       $this->keep('danger', "Non hai permessi sufficenti per modificare questo elemento");
                       $this->router->switchAction('admin/content');
                   }*/

                // do new save
            } else if ($article->getTitle() !== null && $article->getContent() !== null && $article->getStatus() !== null && $article->getCategories()   !== null) {

                $article->setDateCreated(new \DateTime());

                try {
                    $this->articleRepository->save($article);
                } catch (PersisterException $exception) {
                    $this->keep('danger', "Un errore ha impedito il salvataggio");
                    $this->router->switchAction('admin/content');
                    throw new PersisterException($exception);
                }
                //$this->router->switchAction('Admin@editContent', ['id' => $item->id]);
                $this->keep('success', "Salvataggio effettuato con successo");
                $this->router->switchAction('admin/content');
            } else {
                die ('missing data');
            }
            $this->view->render("/admin/content/new");

        } else {
            $this->controlHeader->save = $this->router->link('admin/content/save');
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->renderArgs("states", $this->states);
            $this->view->renderArgs("categories", $this->articleCategoryRepository->findAll());
            $this->view->render("/admin/content/new");
        }
    }

    public
    function read(ServerRequestInterface $serverRequest)
    {
        $id = $serverRequest->getPathParams() ? filter_var($serverRequest->getPathParams()['id'], FILTER_SANITIZE_NUMBER_INT) : null;
        if ($id) {
            $article = $this->articleRepository->find($id);
            if ($article) {
                $this->view->renderArgs("item", $article);
            } else {
                $this->keep("warning", "Nessun elemento trovato");
            }
            $this->view->renderArgs("categories", $this->articleRepository->getCategories());
            $this->controlHeader->save = "#";
            $this->view->renderArgs("states", $this->states);
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->render("/admin/content/new");
        } else {
            $user = $this->loadUser();
            if ($user->isSuperUser()) {
                $this->view->renderArgs('articles', $this->articleRepository->findAll());
            } else if ($this->loadUser()->isAdmin()) {
                $this->view->renderArgs('items', $this->articleRepository->getUserArticles($user));
            }
            $this->controlHeader->new = $this->router->link('admin/content/new');
            $this->controlHeader->delete = true;
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->render("/admin/content/index");
        }

    }

    public
    function update(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement update() method.
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


}