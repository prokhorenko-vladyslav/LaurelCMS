<?php

use Laurel\CMS\Contracts\ModuleContract;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Managers\ModuleManager;

/**
 * Helper for getting module manager from the CMS
 */
if (!function_exists('moduleManager')) {
    function moduleManager() : ModuleManager
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
    function module(string $moduleAlias) : ModuleContract
    {
        return LaurelCMS::instance()->moduleManager()->getModule($moduleAlias);
    }
}
