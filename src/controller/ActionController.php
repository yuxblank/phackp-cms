<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 02/04/18
 * Time: 20.24
 */

namespace cms\controller;


use cms\library\crud\Response;
use DI\Annotation\Inject;

class ActionController extends Admin
{
    /**
     * @Inject("cms.actions")
     */
    private $actions;

    public function getActions() {


        $parsedActions = [];
        foreach ($this->actions as $action) {
            $action['url'] = $this->router->alias($action['action']);
            if ($action['filter']) {
                foreach ($action['filter'] as &$filter) {
                    if ($filter['action']) {
                        $filter['url'] = $this->router->alias($filter['action']);
                    }
                    unset($filter);
                }
            }
            $parsedActions[]  = $action;
        }

        return Response::ok($parsedActions)->build();

    }

}