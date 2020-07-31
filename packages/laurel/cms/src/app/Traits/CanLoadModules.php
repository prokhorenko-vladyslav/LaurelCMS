<?php


namespace Laurel\CMS\Traits;


use Illuminate\Support\Collection;
use Laurel\CMS\Contracts\ModuleContract;
use Laurel\CMS\Exceptions\{AliasHasNotBeenFoundedException,
    ModuleAlreadyExistsException,
    ModuleCannotBeForgottenException,
    ModuleNotFoundException};
use Prophecy\Exception\Doubler\ClassNotFoundException;
use Psy\Exception\TypeErrorException;

trait CanLoadModules
{
    protected Collection $modules;

    public function getStaticModules() : Collection
    {
        $modules = config('laurel.cms.core.modules', []);
        throw_if(!is_array($modules), TypeErrorException::class, ...['List of the modules must be an array']);
        return collect($modules);
    }

    public function isModuleLoaded(string $moduleAlias) : bool
    {
        return $this->modules->has($moduleAlias);
    }

    public function getModules() : Collection
    {
        return $this->modules;
    }

    public function getModule(string $moduleAlias) : ModuleContract
    {
        throw_if(!$this->isModuleLoaded($moduleAlias), ModuleNotFoundException::class, ...["Module with alias \"{$moduleAlias}\" has not been founded"]);
        return $this->modules->get($moduleAlias);
    }

    public function getModulesAliases() : array
    {
        $moduleAliases = config('laurel.cms.core.aliases', []);
        throw_if(!is_array($moduleAliases), TypeErrorException::class, ...["List of module aliases must be an array"]);
        return $moduleAliases;
    }

    public function hasAlias(string $moduleAlias) : bool
    {
        return key_exists($moduleAlias, $this->getModulesAliases());
    }

    public function getAliasClass(string $moduleAlias) : string
    {
        throw_if(!key_exists($moduleAlias, $this->getModulesAliases()), AliasHasNotBeenFoundedException::class, ...["Class for alias \"{$moduleAlias}\" has not been founded"]);
        return $this->getModulesAliases()[$moduleAlias];
    }

    public function loadModules(array $modules) : self
    {
        foreach ($modules as $moduleAlias => $moduleClass) {
            $this->loadModule($moduleAlias, $moduleClass);
        }

        return $this;
    }

    public function loadModulesIf(bool $condition, array $modules) : self
    {
        if ($condition) {
            $this->loadModules($modules);
        }

        return $this;
    }

    public function loadModule(string $moduleAlias, string $defaultModuleClass, ?string $implementContract = null) : self
    {
        $moduleClass = $this->hasAlias($moduleAlias) ? $this->getAliasClass($moduleAlias) : $defaultModuleClass;

        $module = new $moduleClass;
        throw_if($this->modules->has($moduleAlias), ModuleAlreadyExistsException::class, ...["Module with alias \"{$moduleAlias}\" already exists"]);
        throw_if(!$module instanceof ModuleContract, TypeErrorException::class, ...["Module \"{$moduleAlias}\" => \"{$moduleClass}\" does not implement " . ModuleContract::class]);
        throw_if(!empty($implementContract) && !interface_exists($implementContract), ClassNotFoundException::class, ...["Contract \"{$implementContract}\" has not been founded", $implementContract]);
        throw_if(!empty($implementContract) && !$module instanceof $implementContract, TypeErrorException::class, ...["Module \"{$moduleAlias}\" => \"{$moduleClass}\" must implement contract \"" . $implementContract . "\""]);

        $module->load();
        $this->modules->put($moduleAlias, $module);

        return $this;
    }

    public function loadModuleIf(bool $condition, string $moduleAlias, string $defaultModuleClass, ?string $implementContract = null) : self
    {
        if ($condition) {
            $this->loadModule($moduleAlias, $defaultModuleClass, $implementContract);
        }

        return $this;
    }

    public function unloadModule(string $moduleAlias) : void
    {
        if ($this->isModuleLoaded($moduleAlias)) {
            $this->getModule($moduleAlias)->unload();
        }
    }

    public function forgetModule(string $moduleAlias, bool $force = false) : self
    {
        if ($this->isModuleLoaded($moduleAlias)) {
            $module = $this->getModule($moduleAlias);
            throw_if(!$module->canBeForgotten() && !$force, ModuleCannotBeForgottenException::class, ...["Module \"{$moduleAlias}\" => \"" . get_class($module) . "\" cannot be forgotten"]);
            $module->unload();
            $this->modules->forget($moduleAlias);
        }
        return $this;
    }

    public function forgetAllModules() : self
    {
        foreach ($this->getModules() as $moduleAlias => $module) {
            $this->forgetModule($moduleAlias, true);
        }
        return $this;
    }
}
