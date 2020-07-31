<?php
    return [
        /**
         * List of modules, which will be loaded on every request
         */
        'modules' => [

        ],

        /**
         * List of modules, which will be loaded, when CMS is running in the console
         */
        'console_modules' => [
            'settings' => \Laurel\CMS\Modules\Settings\SettingsModule::class
        ],

        /**
         * List of modules, which will be loaded, when CMS loaded using HTTP Request
         */
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
