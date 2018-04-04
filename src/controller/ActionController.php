<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 02/04/18
 * Time: 20.24
 */

namespace cms\controller;


use cms\library\crud\Response;

class ActionController extends Admin
{


    public function getActions() {

        $actions = [["action" => 'api.articles', "title" => "Articles"]];


        return Response::ok($actions)->build();

    }

}