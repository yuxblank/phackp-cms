<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 31/03/18
 * Time: 20.59
 */

namespace cms\library\crud;


use yuxblank\phackp\routing\api\Router;

class EntityLinker
{

    private $router;

    /**
     * EntityLinker constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
     $this->router = $router;
    }

    /**
     * @param LinkableEntity $entity
     * @throws \yuxblank\phackp\routing\exception\RouterException
     */
    public function make(LinkableEntity $entity) {
        $entity->setLink(
            $this->router->alias(
                $entity->getAction(),
                $entity->getParameters()
            )
        );
    }
}