<?php

use Laurel\CMS\Contracts\ModuleContract;
use Laurel\CMS\Core\Responses\ServiceResponse;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Managers\ModuleManager;

/**
 * Helper for getting module manager from the CMS
 */
if (!function_exists('moduleManager')) {
    function moduleManager(): ModuleManager
    {
        return LaurelCMS::instance()->moduleManager();
    }
}

/**
 * Helper for getting module object from the CMS
 *
 * @param string $moduleAlias
 * @return ModuleContract
 * @throws Throwable
 */
if (!function_exists('module')) {
    function module(string $moduleAlias): ModuleContract
    {
        return LaurelCMS::instance()->moduleManager()->getModule($moduleAlias);
    }
}

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
