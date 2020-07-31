<?php


namespace Laurel\CMS;

use Laurel\CMS\Traits\CanLoadModules;

class LaurelCMS
{
    use CanLoadModules;

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
        $this->loadStaticModules();
    }

    public static function isLoaded() : bool
    {
        return !empty(self::$instance);
    }
}
