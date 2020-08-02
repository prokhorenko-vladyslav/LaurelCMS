<?php


namespace Laurel\CMS\Abstracts;

use Laurel\CMS\Contracts\ModuleContract;
use Psy\Exception\TypeErrorException;
use Throwable;

/**
 * Abstract class with general methods and fields for creating all modules
 *
 * Class Module
 * @package Laurel\CMS\Abstracts
 */
abstract class Module implements ModuleContract
{
    /**
     * Singleton module instance
     *
     * @var static $this
     */
    protected static self $instance;

    /**
     * Module constructor. Creating of the new object is disabled
     */
    private function __construct()
    {

    }

    /**
     * Creates module instance and calls its load method.
     * Before creating module object, method will check the existence of the alias.
     * If does, its alias class will be used instead of the default class
     *
     * @return static
     * @throws Throwable
     */
    private static function createInstance() : self
    {
        if (empty(self::$instance)) {
            if (self::hasAlias(static::class)) {
                $className = self::getAliasClass(static::class);
                throw_if(get_parent_class($className) !== static::class, TypeErrorException::class, ...["Alias class \"{$className}\" must extends " . static::class]);
            } else {
                $className = static::class;
            }
            self::$instance = new $className;
            self::$instance->load();
        }

        return self::$instance;
    }

    /**
     * Checks if the module class has alias.
     * List of the aliases will be taken from core config file of the CMS
     *
     * @param string $className
     * @return bool
     */
    private static function hasAlias(string $className)
    {
        return key_exists($className, config('laurel.cms.core.aliases'));
    }

    /**
     * Returns alias class name
     *
     * @param string $className
     * @return string|null
     */
    private static function getAliasClass(string $className) : ?string
    {
        return config('laurel.cms.core.aliases')[$className] ?? null;
    }

    /**
     * Returns instance of the module class
     *
     * @return static
     * @throws Throwable
     */
    public static function instance() : self
    {
        return self::createInstance();
    }

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
