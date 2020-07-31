<?php


namespace Laurel\CMS\Traits;


use Illuminate\Support\Collection;
use Psy\Exception\TypeErrorException;
use Throwable;

/**
 * Trait for loading HTTP modules
 *
 * Trait CanLoadHttpModules
 * @package Laurel\CMS\Traits
 */
trait CanLoadHttpModules
{
    /**
     * Returns static modules, which has been defined in the core config file in the http_modules section
     *
     * @return Collection
     * @throws Throwable
     */
    public function getStaticModulesForHttp() : Collection
    {
        $modules = config('laurel.cms.core.http_modules', []);
        throw_if(!is_array($modules), TypeErrorException::class, ...['List of the http modules must be an array']);
        return collect($modules);
    }
}
