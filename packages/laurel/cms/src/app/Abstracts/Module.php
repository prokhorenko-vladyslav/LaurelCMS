<?php


namespace Laurel\CMS\Abstracts;

use Laurel\CMS\Contracts\ModuleContract;

/**
 * Abstract class with general methods and fields for creating all modules
 *
 * Class Module
 * @package Laurel\CMS\Abstracts
 */
abstract class Module implements ModuleContract
{
    /**
     * Method, which will be called, when module is loading
     *
     * @return bool
     */
    public function load()
    {
        return true;
    }

    /**
     * Method, which will be called, when module is unloading
     *
     * @return bool
     */
    public function unload()
    {
        return true;
    }

    /**
     * Method, which sets forgetting condition for module
     *
     * @return bool
     */
    public function canBeForgotten() : bool
    {
        return true;
    }
}
