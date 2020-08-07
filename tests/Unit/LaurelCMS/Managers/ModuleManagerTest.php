<?php

namespace Tests\Unit\LaurelCMS\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Laurel\CMS\Abstracts\Module;
use Laurel\CMS\Contracts\ModuleContract;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Managers\ModuleManager;
use Psy\Exception\TypeErrorException;
use Tests\FakeModules\FakeIncorrectModule\FakeIncorrectModule;
use Tests\FakeModules\FakeModule\FakeModule;
use Tests\TestCase;

class ModuleManagerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInstance()
    {
        $this->assertInstanceOf(ModuleManager::class, LaurelCMS::instance()->moduleManager());
    }

    public function testStaticModulesIsCollection()
    {
        $this->assertInstanceOf(Collection::class, LaurelCMS::instance()->moduleManager()->getStaticModules());
    }

    public function testStaticModulesNotIsCollection()
    {
        Config::set('laurel.cms.core.modules', 'not is array');
        $this->expectException(TypeErrorException::class);
        LaurelCMS::instance()->moduleManager()->getStaticModules();
    }

    public function testStaticModulesForHttpIsCollection()
    {
        $this->assertInstanceOf(Collection::class, LaurelCMS::instance()->moduleManager()->getStaticModulesForHttp());
    }

    public function testStaticModulesForHttpNotIsCollection()
    {
        Config::set('laurel.cms.core.http_modules', 'not is array');
        $this->expectException(TypeErrorException::class);
        LaurelCMS::instance()->moduleManager()->getStaticModulesForHttp();
    }

    public function testStaticModulesForConsoleIsCollection()
    {
        $this->assertInstanceOf(Collection::class, LaurelCMS::instance()->moduleManager()->getStaticModulesForConsole());
    }

    public function testStaticModulesForConsoleNotIsCollection()
    {
        Config::set('laurel.cms.core.console_modules', 'not is collection');
        $this->expectException(TypeErrorException::class);
        LaurelCMS::instance()->moduleManager()->getStaticModulesForConsole();
    }

    public function testIsModuleLoaded()
    {
        $this->assertTrue(LaurelCMS::instance()->moduleManager()->isModuleLoaded('settings'));
    }

    public function testNotIsModuleLoaded()
    {
        $this->assertFalse(LaurelCMS::instance()->moduleManager()->isModuleLoaded('module_not_exists'));
    }

    public function testModulesListIsCollection()
    {
        $this->assertInstanceOf(Collection::class, LaurelCMS::instance()->moduleManager()->getModules());
    }

    public function testForgetModule()
    {
        LaurelCMS::instance()->moduleManager()->loadModule('fake_module', FakeModule::class);
        if (LaurelCMS::instance()->moduleManager()->isModuleLoaded('fake_module')) {
            LaurelCMS::instance()->moduleManager()->forgetModule('fake_module');
            $this->assertTrue(!LaurelCMS::instance()->moduleManager()->isModuleLoaded('fake_module'));
        } else {
            $this->assertTrue(false);
        }
    }

    public function testModuleIsLoaded()
    {
        LaurelCMS::instance()->moduleManager()->forgetModule('fake_module');
        LaurelCMS::instance()->moduleManager()->loadModules([
            'fake_module' => FakeModule::class
        ]);
        $this->assertTrue(LaurelCMS::instance()->moduleManager()->isModuleLoaded('fake_module'));
    }

    public function testModuleIsIncorrect()
    {
        $this->expectException(TypeErrorException::class);
        $this->expectExceptionMessage("Module \"fake_incorrect_module\" => \"" . FakeIncorrectModule::class . "\" does not implement " . ModuleContract::class);
        LaurelCMS::instance()->moduleManager()->loadModules([
            'fake_incorrect_module' => FakeIncorrectModule::class
        ]);
    }

    public function testModuleNotLoadedIf()
    {
        LaurelCMS::instance()->moduleManager()->forgetModule('fake_module');
        LaurelCMS::instance()->moduleManager()->loadModuleIf(false, 'fake_module', FakeModule::class);
        $this->assertFalse(LaurelCMS::instance()->moduleManager()->isModuleLoaded('fake_module'));
    }

    public function testLoadModuleIf()
    {
        LaurelCMS::instance()->moduleManager()->loadModuleIf(true, 'fake_module', FakeModule::class);
        $this->assertTrue(LaurelCMS::instance()->moduleManager()->isModuleLoaded('fake_module'));
    }

    public function testModuleNotLoadedIfClosure()
    {
        LaurelCMS::instance()->moduleManager()->forgetModule('fake_module');
        LaurelCMS::instance()->moduleManager()->loadModuleIf(function() {
            return false;
        }, 'fake_module', FakeModule::class);
        $this->assertFalse(LaurelCMS::instance()->moduleManager()->isModuleLoaded('fake_module'));
    }

    public function testLoadModuleIfClosure()
    {
        LaurelCMS::instance()->moduleManager()->forgetModule('fake_module');
        LaurelCMS::instance()->moduleManager()->loadModuleIf(function() {
            return true;
        }, 'fake_module', FakeModule::class);
        $this->assertTrue(LaurelCMS::instance()->moduleManager()->isModuleLoaded('fake_module'));
    }

    public function testForgetAllModules()
    {
        if (!empty(LaurelCMS::instance()->moduleManager()->getModules())) {
            LaurelCMS::instance()->moduleManager()->forgetAllModules();
            $this->assertTrue(!empty(LaurelCMS::instance()->moduleManager()->getModules()));
        } else {
            $this->assertTrue(false, 'Modules is empty...');
        }
    }
}
