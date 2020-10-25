<?php

namespace Database\Seeders;

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
        if (!User::findByLogin('admin')) {
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
        }

        $this->call(\Laurel\CMS\Modules\Settings\Database\Seeds\SettingSeeder::class);


        dd('awdawd');
    }
}
