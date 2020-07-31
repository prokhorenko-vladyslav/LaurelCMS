<?php


namespace Laurel\CMS\Traits;


use Illuminate\Support\Collection;
use Psy\Exception\TypeErrorException;

trait CanLoadHttpModules
{
    public function getStaticModulesForHttp() : Collection
    {
        $modules = config('laurel.cms.core.http_modules', []);
        throw_if(!is_array($modules), TypeErrorException::class, ...['List of the http modules must be an array']);
        return collect($modules);
    }
}
