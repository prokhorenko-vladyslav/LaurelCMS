<?php

use Illuminate\Support\Facades\Log;
use Laurel\CMS\Core\Responses\ServiceResponse;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Modules\Notification\Types\ErrorNotification;

/**
 * Checks value and return true, if it seems like json
 *
 * @param string $value
 * @return bool
 */
if (!function_exists('valuesIsJson')) {
    function valueIsJson(string $value)
    {
        json_decode($value);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('serviceResponse')) {
    function serviceResponse(int $code, bool $status, string $alias, array $data = [], $notifications = [])
    {
        return new ServiceResponse($code, $status, $alias, $data, $notifications);
    }
}

if (!function_exists('cms')) {
    function cms() : LaurelCMS
    {
        return LaurelCMS::instance();
    }
}

if (!function_exists('logAndSendServerError')) {
    function logAndSendServerError(string $logMessage)
    {
        Log::critical($logMessage, debug_backtrace());
        return serviceResponse(500, false, 'server_error', [], new ErrorNotification(__('errors.server_error')))->respond();
    }
}
