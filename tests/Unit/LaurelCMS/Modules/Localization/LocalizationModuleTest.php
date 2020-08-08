<?php

namespace Tests\Unit\LaurelCMS\Modules\Localization;

use Illuminate\Support\Collection;
use Laurel\CMS\Exceptions\ModuleCannotBeForgottenException;
use Laurel\CMS\LaurelCMS;
use Laurel\CMS\Modules\Localization\Exceptions\LocaleHasNotBeenFoundException;
use Laurel\CMS\Modules\Localization\Http\Middleware\LocalizationMiddleware;
use Laurel\CMS\Modules\Localization\LocalizationModule;
use League\Flysystem\FileNotFoundException;
use Tests\TestCase;

class LocalizationModuleTest extends TestCase
{
    public function testIsLocalizationModuleLoaded()
    {
        LaurelCMS::instance()->moduleManager()->loadModule('localization', LocalizationModule::class);
        $this->assertTrue(LaurelCMS::instance()->moduleManager()->isModuleLoaded('localization'));
    }

    public function testCanBeForgottenLocalization()
    {
        $this->expectException(ModuleCannotBeForgottenException::class);
        $this->expectExceptionMessage('Module "localization" => "' . LocalizationModule::class . '" cannot be forgotten');
        LaurelCMS::instance()->moduleManager()->forgetModule('localization');
    }

    public function testLocalizationMiddleware()
    {
        $this->assertArrayHasKey('*', LocalizationModule::instance()->getModuleMiddleware());
    }

    public function testMiddlewareExisting()
    {
        foreach (LocalizationModule::instance()->getModuleMiddleware() as $routeGroup => $middlewareClass) {
            $this->assertIsNotArray($middlewareClass);
            $this->assertTrue(class_exists($middlewareClass));
        }
    }

    public function testLoadTranslations()
    {
        $translations = LocalizationModule::instance()->loadTranslations()->getTranslations();
        $this->assertInstanceOf(Collection::class, $translations);
        foreach ($translations as $translationKey => $translationValue) {
            $this->assertIsNotArray($translationValue);
            $this->assertNotEmpty(__($translationKey));
        }
    }

    public function testLoadTranslationsForNotFoundedLocale()
    {
        $this->expectException(LocaleHasNotBeenFoundException::class);
        $translations = LocalizationModule::instance()->loadTranslations(null, 'not_funded_locale')->getTranslations();
        $this->assertInstanceOf(Collection::class, $translations);

        foreach ($translations as $translationKey => $translationValue) {
            $this->assertIsNotArray($translationValue);
            $this->assertNotEmpty(__($translationKey));
        }
    }

    public function testLoadTranslationsForNotFoundedDirectory()
    {
        $this->expectException(FileNotFoundException::class);
        LocalizationModule::instance()->loadTranslations('not_existing_directory', 'en')->getTranslations();
    }
}
