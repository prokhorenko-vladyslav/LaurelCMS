<?php

namespace Laurel\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Laurel\CMS\Console\Commands\CreateMigrationForCMS;
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
        $this->loadMigrations();
        $this->loadCommands();
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
            ->setRoot($this->cmsRoot)
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
        require_once $this->composePath('/Helpers/core.php');
    }

    /**
     * Need to rewrite using recursion. Migrations for modules must loads from Modules/{ModuleName}/migrations folder
     *
     * @throws Throwable
     */
    protected function loadMigrations()
    {
        $mainPath = $this->composePath('/../database/migrations//Modules');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);

        $mainPath = $this->composePath('/../database/migrations//Core');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge($paths, $directories);

        $mainPath = $this->composePath('/../database/migrations/');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge($paths, $directories, [$mainPath]);

        $this->loadMigrationsFrom($paths);
    }

    public function scanMigrationsDir($dir)
    {
        $result = array();

       $cdir = scandir($dir);
       foreach ($cdir as $key => $value)
       {
          if (!in_array($value,array(".",".."))) {
             if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $result[$value] = $this->scanMigrationsDir($dir . DIRECTORY_SEPARATOR . $value);
             } else {
                $result[] = $value;
             }
          }
       }

       return $result;
    }

    protected function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateMigrationForCMS::class
            ]);
        }
    }

    /**
     * Method loads config files and merges it with config parameters of the Laravel
     */
    protected function loadConfig()
    {
        $this->mergeConfigFrom(
            $this->composePath('/../config/core.php'),
            'laurel.cms.core'
        );
        $this->mergeConfigFrom(
            $this->composePath('/../config/settings.php'),
            'laurel.cms.settings'
        );
    }

    /**
     * Method adds to the filepath path of the CMS app folder
     *
     * @param string $path
     * @return string
     * @throws Throwable
     */
    protected function composePath(string $path) : string
    {
        $fileFullPath = $this->cmsRoot . $path;
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
            $this->composePath('/../config/core.php') => config_path('laurel/cms/core.php'),
            $this->composePath('/../config/settings.php') => config_path('laurel/cms/settings.php'),
        ], 'config');
    }
}
