<?php

namespace Laurel\CMS\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Laurel\CMS\Console\Commands\CreateMigrationForCMS;
use Laurel\CMS\Contracts\BladeExtensionContract;
use Laurel\CMS\Contracts\ModuleContract;
use Laurel\CMS\Exceptions\MiddlewareGroupHasNotBeenFoundException;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Modules\Auth\AuthModule;
use Laurel\CMS\Modules\Auth\Models\Token;
use Laurel\CMS\Modules\Localization\Http\Middleware\LocalizationMiddleware;
use Laurel\CMS\Modules\Localization\LocalizationModule;
use Laurel\CMS\Modules\Notification\Contracts\NotificationsModuleContract;
use Laurel\CMS\Modules\Notification\NotificationsModule;
use Laurel\CMS\Modules\Settings\Contracts\SettingModuleContract;
use Laurel\CMS\Modules\Settings\NewSettingsModule;
use Laurel\CMS\Modules\Settings\SettingsModule;
use Psy\Exception\TypeErrorException;
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
     * Register services.
     *
     * @return void
     * @throws Throwable
     */
    public function register()
    {
        $this->loadHelpers();
        $this->loadCoreConfig();

        foreach (config('laurel.cms.core.modules') as $abstractClass => $concreteClass) {
            cms()->putModule($abstractClass, $concreteClass);
        }
    }

    /**
     * Bootstrap services. Also, method creates CMS instance and load main modules
     *
     * @return void
     * @throws Throwable
     */
    public function boot()
    {
        $this->loadMigrations();
        $this->loadCommands();
        $this->loadExtensions();
        $this->registerPublishes();
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
        $mainPath = $this->composePath('/../database/migrations/Modules');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);

        $mainPath = $this->composePath('/../database/migrations/Core');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge($paths, $directories);

        $mainPath = $this->composePath('/../database/migrations/');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge($paths, $directories, [$mainPath]);

        $this->loadMigrationsFrom($paths);
    }

    /**
     * Method for loading commands for CMS
     */
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
    protected function loadCoreConfig()
    {
        $this->mergeConfigFrom(
            $this->composePath('/../config/core.php'),
            'laurel.cms.core'
        );
        $this->mergeConfigFrom(
            $this->composePath('/../config/settings.php'),
            'laurel.cms.settings'
        );
        $this->mergeConfigFrom(
            $this->composePath('/../config/packages.php'),
            'laurel.cms.packages'
        );
        $this->mergeConfigFrom(
            $this->composePath('/../config/extensions.php'),
            'laurel.cms.extensions'
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
        $fileFullPath = LaurelCMS::instance()->getRoot() . $path;
        throw_if(!file_exists($fileFullPath), FileNotFoundException::class, ...[$fileFullPath]);
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
        ], 'config');
    }

    protected function loadExtensions()
    {
        $this->loadBladeExtensions();
        $this->loadPassportExtensions();
    }

    protected function loadBladeExtensions()
    {
        $bladeExtensions = config('laurel.cms.extensions.blade', []);
        throw_if(!is_array($bladeExtensions), TypeErrorException::class, ...['Blade extensions must be an array']);

        foreach ($bladeExtensions as $bladeExtensionClass) {
            $bladeExtension = new $bladeExtensionClass;
            throw_if(!$bladeExtension instanceof BladeExtensionContract, TypeErrorException::class, ...["Blade extensions class \"{$bladeExtensionClass}\" does not implement " . BladeExtensionContract::class]);

            $directiveMethod = $bladeExtension->isCondition() ? "if" : "directive";

            Blade::$directiveMethod($bladeExtension->getDirectiveName(), function() use ($bladeExtension) {
                return $bladeExtension->getDirectiveExpression();
            });
        }
    }

    protected function loadPassportExtensions()
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        Passport::tokensExpireIn(now()->addHours(
            cms()->module(SettingModuleContract::class)->findOrDefault('admin.token_lifetime_in_hours', 1)
        ));
        Passport::useTokenModel(Token::class);
    }
}
