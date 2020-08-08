<?php


namespace Laurel\CMS\Modules\Localization;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Laurel\CMS\Abstracts\Module;
use Laurel\CMS\Modules\Localization\Exceptions\LocaleHasNotBeenFoundException;
use Laurel\CMS\Modules\Localization\Http\Controllers\TranslationController;
use Laurel\CMS\Modules\Localization\Http\Middleware\LocalizationMiddleware;
use League\Flysystem\FileNotFoundException;
use Psy\Exception\TypeErrorException;

class LocalizationModule extends Module
{
    protected Collection $translations;

    public function load()
    {

    }

    public function unload()
    {

    }

    public function canBeForgotten(): bool
    {
        return false;
    }

    public function getConfigFiles(): array
    {
        return [
            __DIR__ . '/Config/localization.php'
        ];
    }

    public function getModuleMiddleware(): array
    {
        return [
            '*' => LocalizationMiddleware::class,
        ];
    }

    public function loadModuleWebRoutes()
    {

    }

    public function loadModuleApiRoutes()
    {
        Route::group([
            'namespace' => 'Laurel\\CMS\\Modules\\Localization\\Http\\Controllers\\'
        ], function() {
            Route::get('translations/{group?}', "TranslationController@index")->name('translations');
        });
    }

    public function getTranslations() : ?Collection
    {
        return $this->translations;
    }

    public function loadTranslations(?string $group = null, ?string $lang = null)
    {
        $this->translations = collect([]);
        $lang = !empty($lang) ? $lang : App::getLocale();
        throw_if(!in_array($lang, $this->getModuleConfig()['locales']), LocaleHasNotBeenFoundException::class, ...["Locale \"{$lang}\" has not been found in config file"]);
        $langDirectory = $this->getModuleConfig()['language_files_location'] . $lang . "/" . (!empty($group) ? $group . "/" : "");
        $this->fetchTranslationsFromDirectory($langDirectory, $lang);

        return $this;
    }

    protected function fetchTranslationsFromDirectory(string $langDirectory, string $lang)
    {
        throw_if(!file_exists($langDirectory), FileNotFoundException::class, ...["Directory with translations \"{$langDirectory}\" does not exists"]);
        $langFiles = $this->recursiveFetchFilesForLang($lang, $langDirectory);
        foreach ($langFiles as $langFile) {
            $translations = require $langFile;
            throw_if(!is_array($translations), TypeErrorException::class, ...["Translations, which getted from path \"{$langFile}\", is not an array"]);

            $translationFileKey = $this->getTranslationFileKey($langFile, $lang);
            $this->addTranslationsFromFileToArray($translations, $translationFileKey);
        }
    }

    protected function addTranslationsFromFileToArray(array $translations, string $translationFileKey)
    {
        foreach ($this->makeSimpleTranslationsArray($translations) as $translationKey => $translationString) {
            $this->translations->put($translationFileKey . "." . $translationKey, $translationString);
        }
    }

    protected function getTranslationFileKey(string $langFile, string $lang) : string
    {
        $fileNameWithoutRoot = str_replace($this->getModuleConfig()['language_files_location'] . $lang . "/", '', $langFile);
        $fileName = explode('.', $fileNameWithoutRoot)[0];
        return str_replace(['\\', '/'], '.', $fileName);
    }

    protected function recursiveFetchFilesForLang(string $lang, ?string $directory = null, array $files = [])
    {
        $dirContent = array_diff(scandir($directory), ['.', '..']);
        foreach ($dirContent as $dirElement) {
            $dirElementPath = $directory . $dirElement;
            if (is_dir($dirElementPath)) {
                $files = array_merge($this->recursiveFetchFilesForLang($lang, $dirElementPath . "/", $files));
            } else {
                $files[] = $dirElementPath;
            }
        }

        return $files;
    }

    protected function makeSimpleTranslationsArray(array $translations, array $simpleArray = [], string $keyPrefix = '')
    {
        foreach ($translations as $translationKey => $translationString) {
            $newKeyPrefix = empty($keyPrefix) ? $translationKey : "{$keyPrefix}.{$translationKey}";
            if (is_array($translationString)) {
                $simpleArray = array_merge($simpleArray, $this->makeSimpleTranslationsArray($translationString, $simpleArray, $newKeyPrefix));
            } else {
                $simpleArray[$newKeyPrefix] = $translationString;
            }
        }

        return $simpleArray;
    }
}
