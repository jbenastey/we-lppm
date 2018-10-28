<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

defined('MONITORING_PATH') || define('MONITORING_PATH', APP_PATH . '/monitoring');
defined('OFFICE_PATH') || define('OFFICE_PATH', APP_PATH . '/office');
defined('LPPM_PATH') || define('LPPM_PATH', APP_PATH . '/lppm');


return new \Phalcon\Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbnameOffice' => 'lppm_office',
        'dbnameLppm' => 'lppm',
        'dbnameMonitoring' => '',
        'charset' => 'utf8',
    ],
    'application' => [
        'appDir' => APP_PATH . '/',
        //module TA
        'officeModule' => OFFICE_PATH,
        'officeModelsDir' => OFFICE_PATH . '/models/',
        'officeViewsDir' => OFFICE_PATH . '/views/',
        'officeControllersDir' => OFFICE_PATH . '/controllers/',
        //module Penjadwalan
        'lppmModule' => LPPM_PATH,
        'lppmModelsDir' => LPPM_PATH . '/models/',
        'lppmViewsDir' => LPPM_PATH . '/views/',
        'lppmControllersDir' => LPPM_PATH . '/controllers/',
        //
        'monitoringModule' => MONITORING_PATH,
        'monitoringModelsDir' => MONITORING_PATH . '/models/',
        'monitoringViewsDir' => MONITORING_PATH . '/views/',
        'monitoringControllersDir' => MONITORING_PATH . '/controllers/',

        // umum
        'formsDir' => APP_PATH . '/forms/',
        'migrationsDir' => APP_PATH . '/migrations/',
        'pluginsDir' => APP_PATH . '/plugins/',
        'libraryDir' => APP_PATH . '/library/',
        'cacheDir' => BASE_PATH . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
],
    'smtp' => [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'security' => 'tls',
    ],
    'user' => [
        'username' => 'apps@uin-suska.ac.id',
        'password' => 'aamqlutampzwzllz',
        'from' => [
            'apps@uin-suska.ac.id' => 'Koordinator TA'
        ],

    ],


]);
