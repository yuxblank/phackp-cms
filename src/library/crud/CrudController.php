<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/06/2017
 * Time: 17:29
 */

namespace cms\library\crud;



use yuxblank\phackp\http\api\ServerRequestInterface;

interface CrudController
{

    public function create(ServerRequestInterface $serverRequest);
    public function read(ServerRequestInterface $serverRequest);
    public function update(ServerRequestInterface $serverRequest);
    public function delete(ServerRequestInterface $serverRequest);

}