<?php

namespace LPPMKP\Monitoring;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Db\Adapter\Pdo\Mysql as Database;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers the module auto-loader
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $config = $di->getConfig();

        $loader = new Loader();
        $loader->registerNamespaces(
            [
                'LPPMKP\Forms' => $config->application->formsDir,
                'LPPMKP\Library' => $config->application->libraryDir,
                'LPPMKP\Migrations' => $config->application->migrationsDir,
                'LPPMKP\Plugins' => $config->application->libraryDir,



                'LPPMKP\Monitoring\Models' => $config->application->monitoringModelsDir,
                'LPPMKP\Monitoring\Views' => $config->application->monitoringViewsDir,
                'LPPMKP\Monitoring\Controllers' => $config->application->monitoringControllersDir,

                'LPPMKP\Office\Models' => $config->application->officeModelsDir,
                'LPPMKP\Office\Views' => $config->application->officeViewsDir,
                'LPPMKP\Office\Controllers' => $config->application->officeControllersDir,

                'LPPMKP\Lppm\Models' => $config->application->lppmModelsDir,
                'LPPMKP\Lppm\Views' => $config->application->lppmViewsDir,
                'LPPMKP\Lppm\Controllers' => $config->application->lppmControllersDir,
            ]
        );

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {

        // Registering a dispatcher
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('LPPMKP\Monitoring\Controllers\\');
            return $dispatcher;
        });


        // Registering the view component
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir($this->getConfig()->application->monitoringViewsDir);

            $view->registerEngines([
                '.volt' => function ($view) {
                    $config = $this->getConfig();

                    $volt = new VoltEngine($view, $this);

                    $volt->setOptions([
                        'compiledPath' => $config->application->cacheDir,
                        'compiledSeparator' => '_'
                    ]);

                    return $volt;
                },
                '.phtml' => PhpEngine::class,
                '.php' => PhpEngine::class

            ]);

            return $view;
        });

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', function () {
            $config = $this->getConfig();

            $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
            $params = [
                'host' => $config->database->host,
                'username' => $config->database->username,
                'password' => $config->database->password,
                'dbname' => $config->database->dbnameMonitoring,
                'charset' => $config->database->charset
            ];

            if ($config->database->adapter == 'Postgresql') {
                unset($params['charset']);
            }

            $connection = new $class($params);

            return $connection;
        });
    }
}
