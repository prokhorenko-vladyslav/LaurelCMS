<?php

use Illuminate\Database\Seeder;
use Laurel\CMS\Modules\Auth\Models\IpAddress;
use Laurel\CMS\Modules\Auth\Models\User;
use Laurel\CMS\Modules\Settings\Builders\SettingSectionBuilder;
use Laurel\CMS\Modules\Settings\SettingsModule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param SettingsModule $settingsModule
     * @return void
     */
    public function run(\Laurel\CMS\Modules\Settings\Contracts\SettingModuleContract $settingsModule)
    {
       /* $user = User::create([
            'first_name' => 'Vladislav',
            'login' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $ipAddress = IpAddress::create([
            'ip_address' => '127.0.0.1'
        ]);

        $user->ipAddresses()->save($ipAddress);*/

        $this->call(\Laurel\CMS\Modules\Settings\Database\Seeds\SettingSeeder::class);


        dd('awdawd');
       /* SettingsModule::instance()->createSetting('admin.ip_address.need_to_check', true);
        SettingsModule::instance()->createSetting('admin.ip_address.code_expires_in_minutes', 15);
        SettingsModule::instance()->createSetting('cms.app_name', 'LaurelCMS');
        SettingsModule::instance()->createSetting('admin.token_lifetime_in_hours', 1);
        SettingsModule::instance()->createSetting('admin.lock_admin_panel', 1);
        SettingsModule::instance()->createSetting('admin.lock_after_minutes', 1);*/
    }
}
