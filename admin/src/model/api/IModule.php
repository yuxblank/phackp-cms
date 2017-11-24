<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 30/10/2017
 * Time: 20:59
 */

namespace cms\model\api;


interface IModule
{

    public function getActions(): array;
    public function getNamespace();

}