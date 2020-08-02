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

        ],

        /**
         * List of modules, which will be loaded, when CMS loaded using HTTP Request
         */
        'http_modules' => [

        ],

        /**
         * List of aliases for main classes of the modules. Before creating module object, method will check the
         * existence of the alias. If does, its alias class will be used instead of the default class
         */
        'aliases' => [
//            \Laurel\CMS\Modules\Settings\SettingsModule::class => \App\UpdatedSettingModule::class
        ]
    ];
