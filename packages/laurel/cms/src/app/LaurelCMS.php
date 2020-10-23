<?php


namespace Laurel\CMS;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Laurel\CMS\Exceptions\ModuleManagerNotFoundException;
use Laurel\CMS\Managers\ModuleManager;
use Laurel\CMS\Providers\LaurelCoreServiceProvider;
use League\Flysystem\FileNotFoundException;

/**
 * Main class of Laurel CMS
 *
 * Class LaurelCMS
 * @package Laurel\CMS
 */
class LaurelCMS
{
    protected static ?self $instance = null;
    protected ?string $root;
    protected Collection $modules;

    /**
     * LaurelCMS constructor.
     */
    private function __construct()
    {
        $this->root =  __DIR__;
        $this->modules = collect([]);
    }

    public function addModule(string $abstract, $concrete = null)
    {
        app()->singleton($abstract, $concrete);
        $this->modules->put($abstract, app()->get($abstract));
    }

    public function modules() : Collection
    {
        return $this->modules;
    }

    public function module(string $abstract)
    {
        return $this->modules->get($abstract);
    }

    /**
     * Instance cloning is disabled
     */
    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public function getRoot() : string
    {
        return $this->root;
    }

    public function getRelativeRoot()
    {
        return ltrim(str_replace(app()->basePath(), '', $this->root), '\\');
    }

    /**
     * Method, which returns singleton instance of the CMS
     *
     * @return static
     */
    public static function instance() : self
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getServiceProviders() : array
    {
        return array_merge([
            LaurelCoreServiceProvider::class,
        ], config('laurel.cms.packages.providers', []));
    }

    public function getApiRoutes() : array
    {
        $routes = [];
        foreach (Route::getRoutes()->getIterator() as $route) {
            if (strpos($route->uri, 'api') !== false) {
                if (!empty($route->action['as'])) {
                    $routes[$route->action['as']] = "/" . $route->uri;
                } else {
                    $routes[] = "/" . $route->uri;
                }
            }
        }
        return $routes;
    }

    public function getAppName()
    {
        return settingsModule()->setting('cms.app_name', env('APP_NAME', 'LaurelCMS'));
    }
}
