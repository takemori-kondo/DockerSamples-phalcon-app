<?php
// PHP8.3
declare(strict_types=1);

class LogUtil
{
    // https://datatracker.ietf.org/doc/html/rfc5424
    // https://www.php-fig.org/psr/psr-3/
    public const EMERGENCY = 0;
    public const ALERT = 1;
    public const CRITICAL = 2;
    public const ERROR = 3;
    public const WARNING = 4;
    public const NOTICE = 5;
    public const INFORMATIONAL = 6;
    public const DEBUG = 7;

    private static int $logLevel = self::DEBUG;

    public static function initialize(int $logLevel)
    {
        self::$logLevel = $logLevel;
    }

    public static function error(string $message)
    {
        if (self::ERROR <= self::$logLevel) {
            error_log('ERROR|' . $message);
        }
    }

    public static function warn(string $message)
    {
        if (self::WARNING <= self::$logLevel) {
            error_log('WARN |' . $message);
        }
    }

    public static function info(string $message)
    {
        if (self::INFORMATIONAL <= self::$logLevel) {
            error_log('INFO |' . $message);
        }
    }

    public static function debug(string $message)
    {
        if (self::DEBUG <= self::$logLevel) {
            error_log('DEBUG|' . $message);
        }
    }
}
