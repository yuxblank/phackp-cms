<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 21:16
 */

namespace cms\controller;


use cms\library\crud\Response;
use cms\model\ContentFactory;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use yuxblank\phackp\http\api\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class CategoriesController extends BaseCategoryController
{


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
        if ($result->offsetExists('article.category')) {
            return Response::ok($result->offsetGet('article.category'))->build();
        } else if ($result->offsetExists('article.categories')) {
            return Response::ok($result->offsetGet('article.categories'))->build();
        } else {
            /*            $this->keep("warning", "Nessun elemento trovato");*/
            return Response::error(503)->build();
        }
    }

    public function update(ServerRequestInterface $serverRequest)
    {

        $category = ContentFactory::ArticleCategoryFactory($serverRequest->getParsedBody());
        $category = $this->articleCategoryRepository->update($category);
        return Response::ok($category)->build();

    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        return new JsonResponse(['result' => parent::delete($serverRequest)->offsetGet('users.removed')]);
    }


}