<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 17:57
 */

namespace cms\controller;


use cms\doctrine\repository\ArticleCategoryRepository;
use cms\doctrine\repository\ArticleRepository;
use cms\doctrine\repository\UserRepository;
use cms\overrides\View;
use Psr\Http\Message\ServerRequestInterface;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\routing\api\Router;

class HomeController extends Admin
{

    /** @var ArticleCategoryRepository */
    private $articleCategoryRepository;
    /** @var  ArticleRepository */
    private $articleRepository;

    /**
     * HomeController constructor.
     * @param View $view
     * @param Session $session
     * @param Router $router
     * @param UserRepository $userRepository
     * @param ArticleCategoryRepository $articleCategoryRepository
     * @param ArticleRepository $articleRepository
     */
    public function __construct(View $view, Session $session, Router $router, UserRepository $userRepository,
                                ArticleCategoryRepository $articleCategoryRepository, ArticleRepository $articleRepository

    )
    {
        parent::__construct($view,$session,$router,$userRepository);
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    public function index(ServerRequestInterface $request)

    {
        if ($this->loadUser()->isCustomer()) {
            $this->router->switchAction('clienti');
        }

        $this->view->renderArgs("articleTotal", $this->articleRepository->count());
        $this->view->renderArgs("articleActive", $this->articleRepository->count(true));
        $this->view->renderArgs("categoryTotal", $this->articleCategoryRepository->count());
        $this->view->renderArgs("userActive", $this->userRepository->count(true));
        $this->view->renderArgs("userTotal", $this->userRepository->count(true));
        /*        $this->view->renderArgs("userRole", $userRole);*/
       /* $this->view->renderArgs("banner", $banner);*/
        $this->view->render("/admin/home");
    }

}