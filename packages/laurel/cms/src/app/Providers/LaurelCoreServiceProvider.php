<?php

namespace Laurel\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Modules\Auth\AuthModule;
use Laurel\CMS\Modules\Localization\LocalizationModule;
use Laurel\CMS\Modules\Settings\SettingsModule;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Throwable;

/**
 * LaurelCMS service provider
 *
 * Class LaurelCoreServiceProvider
 * @package Laurel\CMS\Providers
 */
class LaurelCoreServiceProvider extends ServiceProvider
{
    /**
     * Path to the CMS app folder
     *
     * @var string
     */
    protected string $cmsRoot;

    /**
     * LaurelCoreServiceProvider constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->cmsRoot = __DIR__ . '/..';
        parent::__construct($app);
    }

    /**
     * Register services. Also, method loads helpers, config files and registers resources for publishing
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
     * Bootstrap services. Also, method creates CMS instance and load main modules
     *
     * @return void
     * @throws Throwable
     */
    public function boot()
    {
        LaurelCMS::instance()
            ->moduleManager()
            ->loadModule('auth', AuthModule::class)
            ->loadModule('settings', SettingsModule::class)
            ->loadModule('localization', LocalizationModule::class);
    }

    /**
     * Method loads php-files with helpers
     */
    protected function loadHelpers()
    {
        require_once $this->composeFilePath('/Helpers/core.php');
    }

    /**
     * Method loads config files and merges it with config parameters of the Laravel
     */
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

    /**
     * Method adds to the filepath path of the CMS app folder
     *
     * @param string $filePath
     * @return string
     * @throws Throwable
     */
    protected function composeFilePath(string $filePath) : string
    {
        $fileFullPath = $this->cmsRoot . $filePath;
        throw_if(!file_exists($fileFullPath), FileNotFoundException::class);
        return $fileFullPath;
    }

    /**
     * Method registers publishing resources
     */
    protected function registerPublishes()
    {
        $this->registerConfigPublishes();
    }

    /**
     * Method registers config files as resources for publishing
     *
     * @throws Throwable
     */
    protected function registerConfigPublishes()
    {
        $this->publishes([
            $this->composeFilePath('/../config/core.php') => config_path('laurel/cms/core.php'),
            $this->composeFilePath('/../config/settings.php') => config_path('laurel/cms/settings.php'),
        ], 'config');
    }
}
