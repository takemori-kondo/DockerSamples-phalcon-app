<?php
// PHP8.3
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$di = new FactoryDefault();
include APP_PATH . '/config/services.php';
$config = $di->getConfig();
include APP_PATH . '/config/loader.php';
