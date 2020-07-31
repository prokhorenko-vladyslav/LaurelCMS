<?php


namespace Laurel\CMS\Abstracts;


use Illuminate\Support\Facades\Log;
use Laurel\CMS\Contracts\ModuleContract;

abstract class Module implements ModuleContract
{
    public function load()
    {
        // TODO: Implement load() method.
    }

    public function unload()
    {

    }

    public function canBeForgotten() : bool
    {
        return true;
    }

    public function __destruct()
    {
        dump("Destroyed module " . static::class);
    }
}
