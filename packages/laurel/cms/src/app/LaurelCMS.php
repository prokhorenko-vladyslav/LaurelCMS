<?php


namespace Laurel\CMS;

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
    use CanLoadModules, CanLoadConsoleModules, CanLoadHttpModules;

    /**
     * Singleton instance
     *
     * @var LaurelCMS $this
     */
    protected static self $instance;

    /**
     * LaurelCMS constructor.
     */
    protected function __construct()
    {
        self::$instance->modules = collect([]);
        self::$instance->load();
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
        \Laurel\CMS\LaurelCMS::instance()->forgetAllModules();
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
        $this->loadModules($this->getStaticModules()->toArray());
        $this->loadModulesIf(app()->runningInConsole(), $this->getStaticModulesForConsole()->toArray());
        $this->loadModulesIf(!app()->runningInConsole(), $this->getStaticModulesForHttp()->toArray());
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
