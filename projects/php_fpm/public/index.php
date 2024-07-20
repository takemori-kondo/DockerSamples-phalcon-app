<?php
// PHP8.3
declare(strict_types=1);

use Phalcon\Db\Adapter\Pdo\AbstractPdo;
use Phalcon\Di\Di;
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
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * アプリケーション固有の追加の初期化処理
     */
    include APP_PATH . '/config/additional_initialize.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (Throwable $ex) {
    /** @var AbstractPdo */
    $db = Di::getDefault()->get('db');
    if ($db?->isUnderTransaction()) {
        $db->rollback();
    }
    if ($ex instanceof AppDomainException) {
        $msg = $ex->getMessage() . "\n";
        LogUtil::info('AppDomainException| ' . $msg);
        ResponseUtil::setup400_BadRequest(new ErrorDto($msg, (string)$ex->getCode()), $ex->result)->send();
    } else {
        $msg = '<pre>' . $ex->getMessage() . "\n" . $ex->getFile() . '(' . $ex->getLine() . ')' . "\n" . $ex->getTraceAsString() . "\n</pre>";
        LogUtil::error('System Error| ' . $msg);
        if (!$config->get('debug')->get('responsesDebugMessage')) {
            $msg = '';
        }
        ResponseUtil::setup500_InternalServerError($msg)->send();
    }
}
