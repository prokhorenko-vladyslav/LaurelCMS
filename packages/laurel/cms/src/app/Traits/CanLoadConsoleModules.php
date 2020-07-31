<?php


namespace Laurel\CMS\Traits;


use Illuminate\Support\Collection;
use Psy\Exception\TypeErrorException;
use Throwable;

/**
 * Trait for loading Console modules
 *
 * Trait CanLoadConsoleModules
 * @package Laurel\CMS\Traits
 */
trait CanLoadConsoleModules
{
    /**
     * Returns static modules, which has been defined in the core config file in the console_modules section
     *
     * @return Collection
     * @throws Throwable
     */
    public function getStaticModulesForConsole() : Collection
    {
        $modules = config('laurel.cms.core.console_modules', []);
        throw_if(!is_array($modules), TypeErrorException::class, ...['List of the console modules must be an array']);
        return collect($modules);
    }
}
