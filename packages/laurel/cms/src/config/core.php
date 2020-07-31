<?php
    return [
        /**
         * List of modules, which will be loaded on every request
         */
        'modules' => [

        ],

        'console_modules' => [
            'settings' => \Laurel\CMS\Modules\Settings\SettingsModule::class
        ],

        'http_modules' => [
            'auth' => \Laurel\CMS\Modules\Auth\AuthModule::class
        ],

        /**
         * Aliases for overriding modules classes
         */
        'aliases' => [
//            'settings' => \Laurel\CMS\Modules\Localization\LocalizationModule::class
        ]
    ];
