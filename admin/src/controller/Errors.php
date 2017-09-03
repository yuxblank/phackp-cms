<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/06/2017
 * Time: 18:49
 */

namespace cms\controller;


use cms\overrides\View;
use yuxblank\phackp\core\Controller;

class Errors extends Controller
{

    private $view;

    /**
     * Errors constructor.
     * @param View $view
     */
    public function __construct(View $view)
    {
        parent::__construct();
        $this->view = $view;
    }

    public function onBefore()
    {
        // TODO: Implement onBefore() method.
    }

    public function onAfter()
    {
        // TODO: Implement onAfter() method.
    }


    public function error($throwable){

        $this->view->renderArgs('exceptions', $throwable);
        $this->view->render('error/500');
    }

}