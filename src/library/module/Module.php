<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 12.00
 */

namespace cms\library\module;


use yuxblank\phackp\http\api\ServerRequestInterface;

abstract class Module implements ModuleInterface
{

    protected $serverRequest;

    /**
     * Module constructor.
     * @param $serverRequest
     */
    public function __construct(ServerRequestInterface $serverRequest)
    {
        $this->serverRequest = $serverRequest;
    }




}