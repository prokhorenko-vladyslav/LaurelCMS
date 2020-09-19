<?php

use Illuminate\Database\Seeder;
use Laurel\CMS\Modules\Auth\Models\IpAddress;
use Laurel\CMS\Modules\Auth\Models\User;
use Laurel\CMS\Modules\Settings\SettingsModule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Vladislav',
            'login' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $ipAddress = IpAddress::create([
            'ip_address' => '127.0.0.1'
        ]);

        $user->ipAddresses()->save($ipAddress);

        SettingsModule::instance()->createSetting('admin.ip_address.need_to_check', true);
        SettingsModule::instance()->createSetting('admin.ip_address.code_expires_in_minutes', 15);
        SettingsModule::instance()->createSetting('admin.app_name', 'LaurelCMS');
    }
}
