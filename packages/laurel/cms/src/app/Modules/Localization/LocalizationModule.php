<?php


namespace Laurel\CMS\Modules\Localization;

use Laurel\CMS\Abstracts\Module;

class LocalizationModule extends Module
{
    public function load()
    {
        dump('Localization loaded');
    }

    public function unload()
    {
        dump('Localization unloaded');
    }

    public function canBeForgotten(): bool
    {
        return false;
    }

    public function get(string $settingAlias)
    {
        dd($settingAlias);
    }
}
