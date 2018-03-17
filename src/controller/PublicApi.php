<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 24/02/18
 * Time: 14.40
 */

namespace cms\controller;


use yuxblank\phackp\core\Controller;
use yuxblank\phackp\http\api\ServerRequestInterface;

class PublicApi extends Controller
{
    /** @var ServerRequestInterface  */
    protected $serverRequest;

    /**
     * PublicApi constructor.
     * @param $serverRequest
     */
    public function __construct(ServerRequestInterface $serverRequest)
    {
        parent::__construct();
        $this->serverRequest = $serverRequest;
    }


    public function onBefore()
    {
        // TODO: Implement onBefore() method.
    }

    public function onAfter()
    {
        // TODO: Implement onAfter() method.
    }


}