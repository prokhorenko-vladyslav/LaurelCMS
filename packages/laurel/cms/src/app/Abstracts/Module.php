<?php


namespace Laurel\CMS\Abstracts;


use Laurel\CMS\Contracts\ModuleContract;

abstract class Module implements ModuleContract
{
    public function load()
    {
        // TODO: Implement load() method.
    }

    public function unload()
    {
        // TODO: Implement unload() method.
    }

    public function canBeForgotten() : bool
    {
        return true;
    }
}
