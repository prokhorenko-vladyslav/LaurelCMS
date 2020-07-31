<?php


namespace Laurel\CMS\Traits;


use Illuminate\Support\Collection;
use Psy\Exception\TypeErrorException;

trait CanLoadConsoleModules
{
    public function getStaticModulesForConsole() : Collection
    {
        $modules = config('laurel.cms.core.console_modules', []);
        throw_if(!is_array($modules), TypeErrorException::class, ...['List of the console modules must be an array']);
        return collect($modules);
    }
}
