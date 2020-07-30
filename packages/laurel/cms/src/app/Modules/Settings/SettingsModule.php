<?php


namespace Laurel\CMS\Modules\Settings;

use Laurel\CMS\Abstracts\Module;

class SettingsModule extends Module
{
    public function load()
    {
        dump('Settings loaded');
    }

    public function unload()
    {
        dump('Settings unloaded');
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
