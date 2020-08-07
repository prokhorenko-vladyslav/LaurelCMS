<?php

namespace Tests\Unit\LaurelCMS;

use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Managers\ModuleManager;
use League\Flysystem\FileNotFoundException;
use Tests\TestCase;

class LaurelCMSTest extends TestCase
{
    public function testInstanceMethod()
    {
        $this->assertInstanceOf(LaurelCMS::class, LaurelCMS::instance());
    }

    public function testInstanceIsSame()
    {
        $cms = LaurelCMS::instance();
        if ($cms !== LaurelCMS::instance()) {
            $this->fail('Instance method returns another object');
        } else {
            $this->assertTrue(true);
        }
    }

    public function testModuleManagerInstance()
    {
        $this->assertInstanceOf(ModuleManager::class, LaurelCMS::instance()->moduleManager());
    }

    public function testIsLoadedCMS()
    {
        $this->assertTrue(LaurelCMS::isLoaded());
    }

    public function testCorrectCMSRootPath()
    {
        LaurelCMS::instance()->setRoot(base_path() . "/packages/laurel/cms/src/app");
        $this->assertSame(base_path() . "/packages/laurel/cms/src/app", LaurelCMS::instance()->getRoot());
    }

    public function testIncorrectCMSRootPath()
    {
        $this->expectException(FileNotFoundException::class);
        LaurelCMS::instance()->setRoot(base_path() . "/packagesaw/incorrect/path/cms/src/app");
    }

    public function testCorrectCMSRootRelativePath()
    {
        $this->assertSame("/packages/laurel/cms/src/app", LaurelCMS::instance()->getRelativeRoot());
    }

    public function testIncorrectCMSRootRelativePath()
    {
        $this->assertNotSame(base_path() . "/packages/laurel/cms/src/app", LaurelCMS::instance()->getRelativeRoot());
    }
}
