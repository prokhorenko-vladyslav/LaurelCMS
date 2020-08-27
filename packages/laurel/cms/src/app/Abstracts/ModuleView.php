<?php


namespace Laurel\CMS\Abstracts;

use Laurel\CMS\Contracts\ModuleViewContract;

/**
 * Abstract class with general methods and elements for creating all modules
 *
 * Class ModuleView
 * @package Laurel\CMS\Abstracts
 */
abstract class ModuleView implements ModuleViewContract
{
    protected bool $isVueComponent = false;

    public function getView()
    {
        return $this->isVueComponent ? $this->getVueComponent() : $this->getBladeComponent();
    }

    protected abstract function getVueComponent();
    protected abstract function getBladeComponent();
}
