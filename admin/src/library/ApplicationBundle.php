<?php
namespace cms\library;
use yuxblank\phackp\core\Application;

/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 03/03/18
 * Time: 18.58
 */
class ApplicationBundle
{

    /**
     * ApplicationBundle constructor.
     * @param Application $application
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */

    public static function addBundle(Application $application)
    {
        /** @var \cms\library\module\ModuleWire $moduleWire */
        $moduleWire = $application->container()->make(\cms\library\module\ModuleWire::class);
        $moduleWire->registerModules();
        $moduleWire->finalize();
    }


}