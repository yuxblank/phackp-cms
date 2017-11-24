<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 30/10/2017
 * Time: 21:24
 */

namespace api;

use cms\doctrine\repository\ActionRepository;
use DatabaseRouter;
use Doctrine\ORM\EntityManager;
use PHPUnit_Framework_TestCase;
use yuxblank\phackp\database\driver\DoctrineDriver;
use yuxblank\phackp\http\ServerRequest;

class DatabaseRouterTest extends PHPUnit_Framework_TestCase
{

    private $config;
    private $dbconfig;

    private $actionRepository;


    protected function setUp(){
        $path = defined("CONFIG_PATH") ? CONFIG_PATH : "../config/";
        $this->dbconfig = require $path."doctrine.php";
        $em = new DoctrineDriver($this->dbconfig['doctrine.config']);
        $this->actionRepository = new ActionRepository($em->getDriver());
    }


    public function testGetAction(){

        $serverRequest = new ServerRequest();
        $router = new DatabaseRouter($serverRequest,$this->actionRepository);
        $action = $router->findAction();



    }

}
