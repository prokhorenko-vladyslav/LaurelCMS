<?php


namespace Laurel\CMS;

use Laurel\CMS\Traits\CanLoadConsoleModules;
use Laurel\CMS\Traits\CanLoadHttpModules;
use Laurel\CMS\Traits\CanLoadModules;

class LaurelCMS
{
    use CanLoadModules, CanLoadConsoleModules, CanLoadHttpModules;

    protected static self $instance;

    protected function __construct()
    {

    }

    protected function __clone()
    {

    }

    public function __destruct()
    {
        \Laurel\CMS\LaurelCMS::instance()->forgetAllModules();
    }

    public static function instance() : self
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
            self::$instance->modules = collect([]);
            self::$instance->load();
        }
        return self::$instance;
    }

    public function load()
    {
        $this->loadModules($this->getStaticModules()->toArray());
        $this->loadModulesIf(app()->runningInConsole(), $this->getStaticModulesForConsole()->toArray());
        $this->loadModulesIf(!app()->runningInConsole(), $this->getStaticModulesForHttp()->toArray());
    }

    public static function isLoaded() : bool
    {
        return !empty(self::$instance);
    }
}
