<?php

use Laurel\CMS\Core\Responses\ServiceResponse;
use Laurel\CMS\LaurelCMS;

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
    function serviceResponse(int $code, bool $status, string $alias, array $data = [], string $message = '')
    {
        return new ServiceResponse($code, $status, $alias, $data, $message);
    }
}

if (!function_exists('cms')) {
    function cms() : LaurelCMS
    {
        return LaurelCMS::instance();
    }
}
