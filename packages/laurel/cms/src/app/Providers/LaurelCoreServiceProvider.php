<?php

namespace Laurel\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Modules\Auth\AuthModule;
use Laurel\CMS\Modules\Localization\LocalizationModule;
use Laurel\CMS\Modules\Settings\SettingsModule;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class LaurelCoreServiceProvider extends ServiceProvider
{
    protected string $cmsRoot;

    public function __construct($app)
    {
        $this->cmsRoot = __DIR__ . '/..';
        parent::__construct($app);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPublishes();

        $this->loadHelpers();
        $this->loadConfig();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        LaurelCMS::instance()
            ->loadModule('auth', AuthModule::class)
            ->loadModule('settings', SettingsModule::class)
            ->loadModule('localization', LocalizationModule::class);
    }

    protected function loadHelpers()
    {
        require_once $this->composeFilePath('/Helpers/core.php');
    }

    protected function loadConfig()
    {
        $this->mergeConfigFrom(
            $this->composeFilePath('/../config/core.php'),
            'laurel.cms.core'
        );
        $this->mergeConfigFrom(
            $this->composeFilePath('/../config/settings.php'),
            'laurel.cms.settings'
        );
    }

    protected function composeFilePath(string $filePath) : string
    {
        $fileFullPath = $this->cmsRoot . $filePath;
        throw_if(!file_exists($fileFullPath), FileNotFoundException::class);
        return $fileFullPath;
    }

    protected function registerPublishes()
    {
        $this->registerConfigPublishes();
    }

    protected function registerConfigPublishes()
    {
        $this->publishes([
            $this->composeFilePath('/../config/core.php') => config_path('laurel/cms/core.php'),
            $this->composeFilePath('/../config/settings.php') => config_path('laurel/cms/settings.php'),
        ], 'config');
    }
}
