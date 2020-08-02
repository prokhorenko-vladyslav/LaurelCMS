<?php

use Laurel\CMS\Contracts\ModuleContract;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Managers\ModuleManager;

/**
 * Helper for getting module manager from the CMS
 */
function moduleManager() : ModuleManager
{
    return LaurelCMS::instance()->moduleManager();
}

/**
 * Helper for getting module object from the CMS
 *
 * @param string $moduleAlias
 * @return ModuleContract
 * @throws Throwable
 */
function module(string $moduleAlias)
{
    return LaurelCMS::instance()->getModule($moduleAlias);
}
