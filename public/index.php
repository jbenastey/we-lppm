<?php

use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';
    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';


    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    // Register the installed modules
    $application->registerModules([
        'lppm' => [
            'className' => 'LPPMKP\Lppm\Module',
            'path' => $config->application->lppmModule . '/Module.php'
        ],
        'office' => [
            'className' => 'LPPMKP\Office\Module',
            'path' => $config->application->officeModule . '/Module.php'
        ],
        'monitoring' => [
            'className' => 'LPPMKP\Monitoring\Module',
            'path' => $config->application->monitoringModule . '/Module.php'
        ]
    ]);

    echo str_replace(["\n", "\r", "\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}


