<?php


namespace Laurel\CMS;

use Laurel\CMS\Exceptions\ModuleManagerNotFoundException;
use Laurel\CMS\Managers\ModuleManager;
use Laurel\CMS\Traits\CanLoadConsoleModules;
use Laurel\CMS\Traits\CanLoadHttpModules;
use Laurel\CMS\Traits\CanLoadModules;

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
    public function load()
    {
        $this->setModuleManager(ModuleManager::instance());
        $this->moduleManager()->loadModules($this->moduleManager()->getStaticModules()->toArray());
        $this->moduleManager()->loadModulesIf(app()->runningInConsole(), $this->moduleManager()->getStaticModulesForConsole()->toArray());
        $this->moduleManager()->loadModulesIf(!app()->runningInConsole(),$this->moduleManager()->getStaticModulesForHttp()->toArray());
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

    /**
     * Method returns true, if instance has been created and modules have been loaded
     *
     * @return bool
     */
    public static function isLoaded() : bool
    {
        return !empty(self::$instance);
    }
}
