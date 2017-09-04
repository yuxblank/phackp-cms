<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 20:55
 */

namespace cms\controller;


use cms\library\crud\CrudController;
use cms\library\StringUtils;
use cms\model\Category;
use cms\model\Item;
use cms\overrides\View;
use DI\Annotation\Inject;
use Psr\Http\Message\ServerRequestInterface;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\routing\api\Router;

class ContentController extends Admin implements CrudController
{

    /**
     * @Inject
     * @var  StringUtils */
    private $stringUtils;

    /**
     * Todo refactor to use update instead of create
     * @param ServerRequestInterface $serverRequest
     */
    public function create(ServerRequestInterface $serverRequest)
    {
       if ($serverRequest->getMethod() === 'POST'){

           $user = $this->loadUser();

           // model instance

           $item = new Item();

           if ($serverRequest->getParsedBody()['id'] !== null && $serverRequest->getParsedBody()['id'] !== '') {
               $item->id = filter_var($serverRequest->getParsedBody()['id'], FILTER_SANITIZE_NUMBER_INT);
           }

           $item->title = strip_tags(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING));
           $item->content = htmlspecialchars($serverRequest->getParsedBody()['content']);
           $item->status = $serverRequest->getParsedBody()['state'];
           $item->category_id = $serverRequest->getParsedBody()['category'];
           $item->meta_desc = strip_tags($serverRequest->getParsedBody()['meta_description']);
           $item->meta_tags = strip_tags($serverRequest->getParsedBody()['meta_tags']);
           $item->meta_title = $item->title;
           $item->user_id = $user->getId();
           $item->alias = $this->stringUtils->toAscii(filter_var($serverRequest->getParsedBody()['title'], FILTER_SANITIZE_STRING));


           if ($item->id !== null && $item->id !== '' && ($item->title !== null && $item->content !== null && $item->status !== null && $item->category_id !== null)) {
               $ItemLoad = new Item();
               // check authorization
               if ($user->isAuthorized($ItemLoad->findById($item->id)->user()->role)) {
                   $item->date_edit = date('Y-m-d H:i:s');
                   // do update
                   if ($item->update()) {
                       $this->keep('success', "Salvataggio effettuato con successo");
                       $this->router->switchAction('admin/content');
                       //$this->router->switchAction('Admin@editContent', ['id' => $item->id]);
                   } else {
                       $this->keep('danger', "Un errore ha impedito il salvataggio");
                       $this->router->switchAction('admin/content');
                   }

               } else {
                   $this->keep('danger', "Non hai permessi sufficenti per modificare questo elemento");
                   $this->router->switchAction('admin/content');
               }

               // do new save
           } else if ($item->title != null && $item->content != null && $item->status != null && $item->category_id != null) {

               $item->date_created = date('Y-m-d H:i:s');
               if ($item->save()) {
                   $item->id = $item->lastInsertId();
                   //$this->router->switchAction('Admin@editContent', ['id' => $item->id]);
                   $this->keep('success', "Salvataggio effettuato con successo");
                   $this->router->switchAction('admin/content');
               } else {
                   $this->keep('danger', "Un errore ha impedito il salvataggio");
                   $this->router->switchAction('admin/content');
               }
           } else {
               die ('missing data');
           }
           $this->view->render("/admin/content/new");

       } else {
           $this->controlHeader->save = $this->router->link('admin/content/save');
           $this->view->renderArgs('controlHeader', $this->controlHeader);
           $categories = new Category();
           $item = new Item();
           $this->view->renderArgs("states", $item->getStates());
           $this->view->renderArgs("categories", $categories->findAll());
           $this->view->render("/admin/content/new");
       }
    }

    public function read(ServerRequestInterface $serverRequest)
    {
        $item = new Item();
        $id = $serverRequest->getQueryParams() ? filter_var($serverRequest->getQueryParams()['id'], FILTER_SANITIZE_NUMBER_INT) : null;
        if ($id) {
            $article = $item->findById($id);
            if ($article) {
                $this->view->renderArgs("item", $article);
            } else {
                $this->keep("warning", "Nessun elemento trovato");
            }
            $categories = new Category();
            $this->view->renderArgs("categories", $categories->findAll());
            $this->controlHeader->save = "#";
            $this->view->renderArgs("states", $item->getStates());
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->render("/admin/content/new");
        } else {

            $user = $this->loadUser();
            if ($user->isSuperAdmin()) {
                $this->view->renderArgs('items', $item->findAll());
            } else if (Secured::loadUser()->isAdmin()) {
                $this->view->renderArgs('items', $item->filteredArticles($user));
            }
            $this->controlHeader->new = $this->router->link('admin/content/new');
            $this->controlHeader->delete = true;
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->render("/admin/content/index");
        }

    }

    public function update(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement update() method.
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        $User = Secured::loadUser();

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