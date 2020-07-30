<?php


namespace Laurel\CMS\Contracts;


interface ModuleContract
{
    public function load();
    public function unload();
    public function canBeForgotten() : bool;
}
