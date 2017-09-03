<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 11:38
 */

namespace cms\overrides;


use yuxblank\phackp\routing\api\Router;

class View extends \yuxblank\phackp\view\View
{


    /**
     * View constructor.
     * @param array $viewConfig
     * @param array $appConfig
     * @param Router $router
     */
    public function __construct($viewConfig, $appConfig, Router $router)
    {
        parent::__construct($viewConfig,$appConfig, $router);
    }
}