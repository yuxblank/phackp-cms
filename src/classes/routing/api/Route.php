er<?php

use cms\model\api\IModule;
use yuxblank\phackp\routing\api\RouteInterface;

/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 30/10/2017
 * Time: 20:57
 */

interface Route extends RouteInterface
{
    public function getModule(): IModule;
}