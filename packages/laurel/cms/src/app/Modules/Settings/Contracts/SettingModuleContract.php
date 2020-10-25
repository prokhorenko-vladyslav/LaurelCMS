<?php


namespace Laurel\CMS\Modules\Settings\Contracts;


use Laurel\CMS\Contracts\MustHaveRoutes;

interface SettingModuleContract extends MustHaveRoutes, SettingContract, SettingSectionContract
{
    public function getSeedData(string $fileName) : array;
}
