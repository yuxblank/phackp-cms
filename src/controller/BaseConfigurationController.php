<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 10.59
 */

namespace cms\controller;


use cms\library\crud\CrudController;
use yuxblank\phackp\http\api\ServerRequestInterface;

abstract class BaseConfigurationController extends Admin implements CrudController
{
    public function create(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement create() method.
    }

    public function read(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement read() method.
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement update() method.
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        // TODO: Implement delete() method.
    }


}