<?php
use yuxblank\phackp\core\View;
use yuxblank\phackp\database\Model;

/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 00:52
 */
class CrudOperation
{


    private $view;

    /**
     * CrudOperation constructor.
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function createOperation(Model $model){


    }


}