<?php


namespace Laurel\CMS\Abstracts;

use Laurel\CMS\Contracts\ModuleContract;
use Psy\Exception\TypeErrorException;

/**
 * Abstract class with general methods and fields for creating all modules
 *
 * Class Module
 * @package Laurel\CMS\Abstracts
 */
abstract class Module implements ModuleContract
{
    protected static self $instance;

    private function __construct()
    {

    }

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

    private static function hasAlias(string $className)
    {
        return key_exists($className, config('laurel.cms.core.aliases'));
    }

    private static function getAliasClass(string $className) : ?string
    {
        return config('laurel.cms.core.aliases')[$className] ?? null;
    }

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
