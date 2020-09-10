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
    public function setName(string $name) : self;

    public function getName() : string;

    public function getNamespace() : string;

    public function install();

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

    public function getConfigFiles() : array;

    public function getModuleConfig() : ?array;

    public function getModuleMiddleware() : array;

    public function loadModuleWebRoutes();

    public function loadModuleApiRoutes();
}
