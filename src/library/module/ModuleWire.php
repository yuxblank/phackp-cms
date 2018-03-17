<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 12.08
 */

namespace cms\library\module;

use Composer\Autoload\ClassLoader;
use DI\Annotation\Inject;
use yuxblank\phackp\core\Application;

class ModuleWire
{

    const MODULE_CONFIG = 'module.json';
    const BUNDLE_CONFIG = 'bundle.json';

    private $moduleRoot;
    /** @Inject("routes") */
    private $routes;
    /** @Inject("doctrine.config") */
    private $doctrine;
    /** @Inject("DI\Container") */
    private $container;

    /** @var ClassLoader */
    private $classLoader;

    /**
     * ModuleWire constructor.
     * @param string|null $root
     */
    public function __construct()
    {
        $this->moduleRoot = Application::$ROOT . DIRECTORY_SEPARATOR . 'module';
        /*     spl_autoload_register(array($this,'moduleLoader'));*/
        $this->classLoader = require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
    }

    public function registerModules()
    {
        $directories = glob($this->moduleRoot . '/*', GLOB_ONLYDIR);
        $moduleDir = null;
        foreach ($directories as $directory) {

            // first level module
            if (file_exists($directory . DIRECTORY_SEPARATOR . self::BUNDLE_CONFIG)) {
                $moduleConfig = $this->handleModuleRegistration($directory, true);
                // group childs
                $moduleGroup = glob($directory . '/*', GLOB_ONLYDIR);
                foreach ($moduleGroup as $subDirectory) {
                    $this->handleModuleRegistration($subDirectory);
                }
            } else if (file_exists($directory . DIRECTORY_SEPARATOR . self::MODULE_CONFIG)) {
                $moduleGroup = glob($directory . '/*', GLOB_ONLYDIR);
                foreach ($moduleGroup as $subDirectory) {
                    $this->handleModuleRegistration($subDirectory);
                }
            }

        }

    }

    private function handleModuleRegistration(string $directory, bool $bundle = false)
    {
        $fileName = $bundle ? self::BUNDLE_CONFIG : self::MODULE_CONFIG;
        $config = json_decode(file_get_contents($directory . DIRECTORY_SEPARATOR . $fileName));
        if ($config) {
            if (isset($config->autoload)) {
                $this->registerClasses($config->autoload);
            }
            $routesFile = $directory . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routes.php';

            if (file_exists($routesFile)) {
                $this->registerRoutes($routesFile);
            }
            if ($config->database && is_dir($directory . DIRECTORY_SEPARATOR . $config->database->{'entities_path'})) {
                $this->registerEntities($directory . DIRECTORY_SEPARATOR . $config->database->{'entities_path'});
            }
            return $config;
        }
        return null;
    }


    private function registerClasses($classes)
    {
        if (isset($classes->{'psr-4'})) {
            foreach ($classes->{'psr-4'} as $namespace => $dir) {
                $this->classLoader->setPsr4($namespace, $this->moduleRoot . DIRECTORY_SEPARATOR . $dir);
            }
        }
    }

    private function registerRoutes($routes)
    {
        $parsed = require $routes;
        foreach ($parsed as $method => $parsedRoute) {
            foreach ($parsedRoute as $effectiveRoute) {
                $this->routes[$method][] = $effectiveRoute;
            }

        }
    }

    private function registerEntities($entityFolder)
    {
        $this->doctrine['entities_paths'][] = $entityFolder;
    }

    public function finalize()
    {
        $this->container->set('routes', $this->routes);
        $this->container->set('doctrine.config', $this->doctrine);
    }
}