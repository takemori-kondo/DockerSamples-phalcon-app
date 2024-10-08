<?php
// PHP8.3
declare(strict_types=1);

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => '172.16.0.50',
        'username'    => 'common',
        'password'    => 'password_common',
        'dbname'      => 'common',
        'charset'     => 'utf8mb4',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',

        'utilsDir'         => APP_PATH . '/utils/',
        'utilsDbDir'       => APP_PATH . '/utils/db/',
        'utilsRequestDir'  => APP_PATH . '/utils/request/',
        'utilsResponseDir' => APP_PATH . '/utils/response/',
        'timezone'       => 'Asia/Tokyo',
        'logLevel'       => 6, // 0-7. 3=Error, 4=Warning, 6=Informational, 7=Debug
    ],
    'debug' => [
        'responsesDebugMessage' => true,
    ]
]);
