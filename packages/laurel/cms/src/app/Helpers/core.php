<?php

use Laurel\CMS\Contracts\ModuleContract;

/**
 * Helper for getting module object from the CMS
 *
 * @param string $moduleAlias
 * @return ModuleContract
 * @throws Throwable
 */
function module(string $moduleAlias)
{
    return \Laurel\CMS\LaurelCMS::instance()->getModule($moduleAlias);
}
