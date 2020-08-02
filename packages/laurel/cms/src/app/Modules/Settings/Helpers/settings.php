<?php

use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Modules\Settings\SettingsModule;

if (!function_exists('settingsModule')) {
    /**
     * Helper for SettingModule class
     *
     * @return SettingsModule
     * @throws Throwable
     */
    function settingsModule() : SettingsModule
    {
        return LaurelCMS::instance()->moduleManager()->getModule('settings');
    }
}
