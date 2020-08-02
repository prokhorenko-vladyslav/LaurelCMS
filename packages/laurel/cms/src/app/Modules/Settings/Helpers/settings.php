<?php
if (!function_exists('settingsModule')) {
    function settingsModule() : \Laurel\CMS\Modules\Settings\SettingsModule
    {
        return \Laurel\CMS\LaurelCMS::instance()->moduleManager()->getModule('settings');
    }
}
