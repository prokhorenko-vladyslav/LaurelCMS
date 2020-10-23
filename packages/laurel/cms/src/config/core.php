<?php
    return [
        /**
         * Route prefix for modules. Web group
         */
        'modules_web_prefix' => 'modules',

        /**
         * Route name for modules. Web group
         */
        'modules_web_name' => 'modules.',

        /**
         * Route prefix for modules. Api group
         */
        'modules_api_prefix' => 'api/modules',

        /**
         * Route name for modules. Api group
         */
        'modules_api_name' => 'api.modules.',

        'modules' => [
            \Laurel\CMS\Modules\Auth\Contracts\AuthModuleContract::class => \Laurel\CMS\Modules\Auth\AuthModule::class,

            \Laurel\CMS\Modules\Files\Contracts\FilesModuleContract::class => \Laurel\CMS\Modules\Files\FilesModule::class,

            \Laurel\CMS\Modules\Localization\Contracts\LocalizationModuleContract::class => \Laurel\CMS\Modules\Localization\LocalizationModule::class,

            \Laurel\CMS\Modules\Notification\Contracts\NotificationsModuleContract::class => \Laurel\CMS\Modules\Notification\NotificationsModule::class,

            \Laurel\CMS\Modules\Page\Contracts\PageModuleContract::class => \Laurel\CMS\Modules\Page\PageModule::class,

            \Laurel\CMS\Modules\Permission\Contracts\PermissionModuleContract::class => \Laurel\CMS\Modules\Permission\PermissionModule::class,

            \Laurel\CMS\Modules\Post\Contracts\PostModuleContract::class => \Laurel\CMS\Modules\Post\PostModule::class,

            \Laurel\CMS\Modules\Rubric\Contracts\RubricModuleContract::class => \Laurel\CMS\Modules\Rubric\RubricModule::class,

            \Laurel\CMS\Modules\Search\Contracts\SearchModuleContract::class => \Laurel\CMS\Modules\Search\SearchModule::class,

            \Laurel\CMS\Modules\Settings\Contracts\SettingModuleContract::class => \Laurel\CMS\Modules\Settings\SettingsModule::class,

            \Laurel\CMS\Modules\Tag\Contracts\TagModuleContract::class => \Laurel\CMS\Modules\Tag\TagModule::class,

            \Laurel\CMS\Modules\Telegram\Contracts\TelegramModuleContract::class => \Laurel\CMS\Modules\Telegram\TelegramModule::class,

        ]
    ];
