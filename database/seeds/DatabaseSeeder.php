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

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Общие',
                'en' => 'General'
            ],
            [
                'ru' => 'Общие настройки системы',
                'en' => 'General settings of the system'
            ],
            'general',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Дизайн',
                'en' => 'Design'
            ],
            [
                'ru' => 'Выберите тему для Вашего сайта и персонализируйте ее',
                'en' => 'Choose theme for your site and personalize it'
            ],
            'design',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Почта',
                'en' => 'Mail'
            ],
            [
                'ru' => 'Настройте отправки электронных писем',
                'en' => 'Settings for sending mails'
            ],
            'mail',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'СЕО',
                'en' => 'SEO'
            ],
            [
                'ru' => 'Оптимизируйте сайт для поисковых систем',
                'en' => 'Settings for optimizing site for search engines'
            ],
            'seo',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Магазин',
                'en' => 'Shop'
            ],
            [
                'ru' => 'Настройте электронную коммерцию',
                'en' => 'Settings for ecommerce'
            ],
            'shop',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Уведомления',
                'en' => 'Notifications'
            ],
            [
                'ru' => 'Настройте отправку уведомлений',
                'en' => 'Choose events, when you will get notifications from the system'
            ],
            'notifications',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Сервер',
                'en' => 'Server'
            ],
            [
                'ru' => 'Настройте сервер',
                'en' => 'Server settings'
            ],
            'server',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Панель',
                'en' => 'Dashboard'
            ],
            [
                'ru' => 'Персонализируйте административную панель под свои нужды',
                'en' => 'Personalize admin panel for your needs'
            ],
            'dashboard',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Безопасность',
                'en' => 'Security'
            ],
            [
                'ru' => 'Повысьте уровень безопасности CMS',
                'en' => 'Increase security level of CMS'
            ],
            'security',
            '#'
        );

        SettingsModule::instance()->createOrUpdateSettingSection(
            [
                'ru' => 'Локализация',
                'en' => 'Localization'
            ],
            [
                'ru' => 'Переведите систему на различные языки',
                'en' => 'Translate system to different languages'
            ],
            'localization',
            '#'
        );
       /* SettingsModule::instance()->createSetting('admin.ip_address.need_to_check', true);
        SettingsModule::instance()->createSetting('admin.ip_address.code_expires_in_minutes', 15);
        SettingsModule::instance()->createSetting('cms.app_name', 'LaurelCMS');
        SettingsModule::instance()->createSetting('admin.token_lifetime_in_hours', 1);
        SettingsModule::instance()->createSetting('admin.lock_admin_panel', 1);
        SettingsModule::instance()->createSetting('admin.lock_after_minutes', 1);*/
    }
}
