<?php


namespace Laurel\CMS;

use Illuminate\Support\Facades\Route;
use Laurel\CMS\Exceptions\ModuleManagerNotFoundException;
use Laurel\CMS\Managers\ModuleManager;
use League\Flysystem\FileNotFoundException;

/**
 * Main class of Laurel CMS
 *
 * Class LaurelCMS
 * @package Laurel\CMS
 */
class LaurelCMS
{
    /**
     * Singleton instance
     *
     * @var LaurelCMS $this
     */
    protected static self $instance;

    protected ?ModuleManager $moduleManager;
    protected ?string $root;

    /**
     * LaurelCMS constructor.
     */
    protected function __construct()
    {
        $this->load();
    }

    /**
     * Instance cloning is disabled
     */
    protected function __clone()
    {

    }

    /**
     * When instance destructs, all modules must be unloaded and deleted from the list
     */
    public function __destruct()
    {
        \Laurel\CMS\LaurelCMS::instance()->moduleManager()->forgetAllModules();
    }

    public function setRoot(string $root)
    {
        throw_if(!file_exists($root), FileNotFoundException::class, ...["Directory \"{$root}\" has not been found"]);
        $this->root = $root;
        return $this;
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
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Method loads general static modules and modules for console or http requests
     */
    public function load() : self
    {
        $this->setModuleManager(ModuleManager::instance());
        $this->moduleManager()->loadModules($this->moduleManager()->getStaticModules()->toArray());
        $this->moduleManager()->loadModulesIf(app()->runningInConsole(), $this->moduleManager()->getStaticModulesForConsole()->toArray());
        $this->moduleManager()->loadModulesIf(!app()->runningInConsole(),$this->moduleManager()->getStaticModulesForHttp()->toArray());

        return $this;
    }

    public function setModuleManager(ModuleManager $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    public function moduleManager() : ModuleManager
    {
        throw_if(empty($this->moduleManager), ModuleManagerNotFoundException::class, ...['Module manager has not been found']);
        return $this->moduleManager;
    }

    public function getServiceProviders() : array
    {
        return array_merge([
            \Laurel\CMS\Providers\LaurelCoreServiceProvider::class,
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
}
