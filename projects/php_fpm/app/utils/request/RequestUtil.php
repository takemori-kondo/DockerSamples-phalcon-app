<?php
// PHP8.3
declare(strict_types=1);

use Phalcon\Di\Di;
use Phalcon\Http\Request;

class RequestUtil
{
    public const DECODE_OPTION = JSON_INVALID_UTF8_IGNORE | JSON_THROW_ON_ERROR;

    public static function logAndGetRequestParameters(string $__METOHD__): array
    {
        /** @var Request */
        $request = Di::getDefault()->get('request');
        try {
            if ($request->isPost() || $request->isPut() || $request->isPatch() || $request->isDelete()) {
                $rawBody = $request->getRawBody();
                LogUtil::info($__METOHD__, '| ' . $rawBody);
                if (empty($rawBody)) return [];
                return json_decode($rawBody, true, 7, self::DECODE_OPTION);
            }
            if ($request->isGet()) {
                $array = $request->getQuery();
                $arrayStr = substr(str_replace(["\r", "\n"], '', var_export($array, true)), 9, -2);
                LogUtil::info($__METOHD__ . '| ' . $arrayStr);
                return $array ?? [];
            }
            return [];
        } catch (Throwable $ex) {
            throw new AppDomainException("invalid request parameters", null, 0, $ex);
        }
    }
}
