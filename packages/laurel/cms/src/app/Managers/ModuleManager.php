<?php


namespace Laurel\CMS\Managers;

use Closure;
use Illuminate\Support\Collection;
use Laurel\CMS\Contracts\ModuleContract;
use Laurel\CMS\Exceptions\{
    ModuleAlreadyExistsException,
    ModuleCannotBeForgottenException,
    ModuleNotFoundException
};
use Prophecy\Exception\Doubler\ClassNotFoundException;
use Psy\Exception\TypeErrorException;
use ReflectionException;
use ReflectionFunction;
use Throwable;

/**
 * Class for modules manipulating
 *
 * Class ModuleManager
 * @package Laurel\CMS\Managers
 */
class ModuleManager
{
    /**
     * Singleton instance for ModuleManager
     *
     * @var ModuleManager $this
     */
    protected static self $instance;

    /**
     * List of the loaded modules
     *
     * @var Collection
     */
    protected Collection $modules;

    /**
     * ModuleManager constructor.
     */
    protected function __construct()
    {
        $this->modules = collect([]);
    }

    /**
     * @return static
     */
    public static function instance() : self
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Returns all modules, which define in the core config file in the modules section
     *
     * @return Collection
     * @throws Throwable
     */
    public function getStaticModules(): Collection
    {
        $modules = config('laurel.cms.core.modules', []);
        throw_if(!is_array($modules), TypeErrorException::class, ...['List of the modules must be an array']);
        return collect($modules);
    }

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

    /**
     * Checks if module has been loaded or not
     *
     * @param string $moduleAlias
     * @return bool
     */
    public function isModuleLoaded(string $moduleAlias): bool
    {
        return $this->modules->has($moduleAlias);
    }

    /**
     * Returns list of the all loaded modules
     *
     * @return Collection
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    /**
     * Returns module object using its alias
     *
     * @param string $moduleAlias
     * @return ModuleContract
     * @throws Throwable
     */
    public function getModule(string $moduleAlias): ModuleContract
    {
        throw_if(!$this->isModuleLoaded($moduleAlias), ModuleNotFoundException::class, ...["Module with alias \"{$moduleAlias}\" has not been founded"]);
        return $this->modules->get($moduleAlias);
    }

    /**
     * Loads list of modules. Array must be like ['moduleAlias' => 'moduleClass']
     *
     * @param array $modules
     * @return $this
     * @throws Throwable
     */
    public function loadModules(array $modules): self
    {
        foreach ($modules as $moduleAlias => $moduleClass) {
            $this->loadModule($moduleAlias, $moduleClass);
        }

        return $this;
    }

    /**
     * Loads list, of the modules if the condition returns true. As condition can be used bool value or closure
     *
     * @param $condition
     * @param array $modules
     * @return $this
     * @throws ReflectionException
     * @throws Throwable
     */
    public function loadModulesIf($condition, array $modules): self
    {
        throw_if(!is_bool($condition) && !(new ReflectionFunction($condition))->isClosure(), TypeErrorException::class, ...["Condition for module loading can be Closure or bool"]);

        if (
            (is_object($condition) && $condition instanceof Closure && $condition()) ||
            (is_bool($condition) && $condition)
        ) {
            $this->loadModules($modules);
        }

        return $this;
    }

    /**
     * Loads module. For creating class uses module class in the parameters.
     * Also you can set contract, which must be implemented by module class
     *
     * @param string $moduleAlias
     * @param string $moduleClass
     * @param string|null $implementContract
     * @return $this
     * @throws Throwable
     */
    public function loadModule(string $moduleAlias, string $moduleClass, ?string $implementContract = null): self
    {
        $module = $moduleClass::instance();
        throw_if($this->modules->has($moduleAlias), ModuleAlreadyExistsException::class, ...["Module with alias \"{$moduleAlias}\" already exists"]);
        throw_if(!$module instanceof ModuleContract, TypeErrorException::class, ...["Module \"{$moduleAlias}\" => \"{$moduleClass}\" does not implement " . ModuleContract::class]);
        throw_if(!empty($implementContract) && !interface_exists($implementContract), ClassNotFoundException::class, ...["Contract \"{$implementContract}\" has not been founded", $implementContract]);
        throw_if(!empty($implementContract) && !$module instanceof $implementContract, TypeErrorException::class, ...["Module \"{$moduleAlias}\" => \"{$moduleClass}\" must implement contract \"" . $implementContract . "\""]);

        $module->load();
        $this->modules->put($moduleAlias, $module);

        return $this;
    }

    /**
     * Loads module, if the condition returns true. As condition can be used bool value or closure
     *
     * @param $condition
     * @param string $moduleAlias
     * @param string $defaultModuleClass
     * @param string|null $implementContract
     * @return $this
     * @throws ReflectionException
     * @throws Throwable
     */
    public function loadModuleIf($condition, string $moduleAlias, string $defaultModuleClass, ?string $implementContract = null): self
    {
        throw_if(!is_bool($condition) && !(new ReflectionFunction($condition))->isClosure(), TypeErrorException::class, ...["Condition for module loading can be Closure or bool"]);

        if (
            (is_object($condition) && $condition instanceof Closure && $condition()) ||
            (is_bool($condition) && $condition)
        ) {
            $this->loadModule($moduleAlias, $defaultModuleClass, $implementContract);
        }

        return $this;
    }

    /**
     * Call unload method, if the module has been loaded
     *
     * @param string $moduleAlias
     * @throws Throwable
     */
    public function unloadModule(string $moduleAlias): void
    {
        if ($this->isModuleLoaded($moduleAlias)) {
            $this->getModule($moduleAlias)->unload();
        }
    }

    /**
     * Unloads module and deletes it from the list.
     * If force parameter has been setted to true, checking for forgetting availability will be skipped
     *
     * @param string $moduleAlias
     * @param bool $force
     * @return $this
     * @throws Throwable
     */
    public function forgetModule(string $moduleAlias, bool $force = false): self
    {
        if ($this->isModuleLoaded($moduleAlias)) {
            $module = $this->getModule($moduleAlias);
            throw_if(!$module->canBeForgotten() && !$force, ModuleCannotBeForgottenException::class, ...["Module \"{$moduleAlias}\" => \"" . get_class($module) . "\" cannot be forgotten"]);
            $module->unload();
            $this->modules->forget($moduleAlias);
        }
        return $this;
    }

    /**
     * Unloads module and deletes all the modules
     *
     * @return $this
     * @throws Throwable
     */
    public function forgetAllModules(): self
    {
        foreach ($this->getModules() as $moduleAlias => $module) {
            $this->forgetModule($moduleAlias, true);
        }
        return $this;
    }
}
