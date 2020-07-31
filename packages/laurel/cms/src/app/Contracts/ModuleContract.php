<?php


namespace Laurel\CMS\Contracts;


/**
 * Interface, which must be implemented by all modules of the CMS
 *
 * Interface ModuleContract
 * @package Laurel\CMS\Contracts
 */
interface ModuleContract
{
    /**
     * Method, which will be called, when module is loading
     *
     * @return mixed
     */
    public function load();

    /**
     * Method, which will be called, when module is unloading
     *
     * @return mixed
     */
    public function unload();

    /**
     * Method, which sets forgetting condition for module
     *
     * @return bool
     */
    public function canBeForgotten() : bool;
}
