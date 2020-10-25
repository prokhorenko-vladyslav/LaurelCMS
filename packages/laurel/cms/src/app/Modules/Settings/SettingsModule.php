<?php


namespace Laurel\CMS\Modules\Settings;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Route;
use Laurel\CMS\Exceptions\ModelNotDeletedException;
use Laurel\CMS\Modules\Settings\Builders\SettingBuilder;
use Laurel\CMS\Modules\Settings\Builders\SettingSectionBuilder;
use Laurel\CMS\Modules\Settings\Contracts\SettingModuleContract;
use Laurel\CMS\Modules\Settings\Http\Controllers\SettingController;
use Laurel\CMS\Modules\Settings\Models\Setting;
use Laurel\CMS\Modules\Settings\Models\SettingSection;
use Laurel\CMS\Traits\HasSeedData;
use Throwable;

/**
 * Module for manipulating settings
 *
 * Class SettingsModule
 * @package Laurel\CMS\Modules\Settings
 */
class SettingsModule implements SettingModuleContract
{
    use HasSeedData;

    /**
     *
     */
    protected const MODULE_DIRECTORY = __DIR__;

    /**
     * Registers module routes.
     *
     * @param string $group
     * @return void
     */
    public function routes(string $group) : void
    {
        if ($group === 'api') {
            $this->addApiRoutes();
        }
    }

    protected function addApiRoutes()
    {
        Route::name('api.modules.settings.')
            ->prefix('settings')
            ->group(function() {
                Route::get('{section}', [SettingController::class, 'index']);
            });
    }

    /**
     * Registers additional routes.
     *
     * @param string $group
     * @return void
     */
    public function additionalRoutes(string $group): void
    {
        // TODO: Implement additionalRoutes() method.
    }

    /**
     * Creates new setting.
     *
     * @param SettingBuilder $settingBuilder
     * @return Setting
     */
    public function create(SettingBuilder $settingBuilder): Setting
    {
        $settingBuilder->instance()->saveOrFail();
        return $settingBuilder->instance();
    }

    /**
     * Updates specified setting.
     *
     * @param SettingBuilder $settingBuilder
     * @return Setting
     */
    public function update(SettingBuilder $settingBuilder): Setting
    {
        $settingBuilder->instance()->saveOrFail();
        return $settingBuilder->instance();
    }

    /**
     * Deletes specified setting.
     *
     * @param Setting $setting
     * @throws ModelNotDeletedException
     * @return bool
     */
    public function delete(Setting $setting): bool
    {
        if (!$setting->delete()) {
            throw new ModelNotDeletedException(Setting::class . " with id {$setting->id} has not been deleted");
        }

        return true;
    }

    /**
     * Finds and returns setting using specified field.
     *
     * @param string $value
     * @param string|null $field
     * @param bool $throwIfNotFound
     * @return null|Setting
     * @throws Throwable
     */
    public function find(string $value, string $field = 'slug', bool $throwIfNotFound = true): ?Setting
    {
        try {
            return Setting::findBy($field, $value);
        } catch (\Exception $e) {
            throw_if($throwIfNotFound, ModelNotFoundException::class, ...[Setting::class . " with value \"{$value}\" in field {$field} has not been found."]);
            return null;
        }
    }

    /**
     * Finds setting by alias and returns its value or returns default value.
     *
     * @param string $alias
     * @param mixed $defaultValue
     * @return mixed
     * @throws Throwable
     */
    public function findOrDefault(string $alias, $defaultValue = null)
    {
        try {
            return $this->findByAlias($alias)->value;
        } catch (ModelNotFoundException $e) {
            return $defaultValue;
        }
    }

    /**
     * Finds and returns setting using its alias.
     *
     * @param string $alias
     * @param bool $throwIfNotFound
     * @return Builder|Model|null|Setting
     * @throws Throwable
     */
    public function findByAlias(string $alias, bool $throwIfNotFound = true)
    {
        try {
            return Setting::findByAlias($alias);
        } catch (\Exception $e) {
            throw_if($throwIfNotFound, ModelNotFoundException::class, ...[Setting::class . " with alias {$alias} has not been found."]);
            return null;
        }
    }

    /**
     * Creates new setting section.
     *
     * @param SettingSectionBuilder $settingSectionBuilder
     * @throws Throwable
     * @return SettingSection
     */
    public function createSection(SettingSectionBuilder $settingSectionBuilder): SettingSection
    {
        $settingSectionBuilder->instance()->saveOrFail();
        return $settingSectionBuilder->instance();
    }

    /**
     * Updates specified setting section.
     *
     * @param SettingSectionBuilder $settingSectionBuilder
     * @return SettingSection
     */
    public function updateSection(SettingSectionBuilder $settingSectionBuilder): SettingSection
    {
        $settingSectionBuilder->instance()->saveOrFail();
        return $settingSectionBuilder->instance();
    }

    /**
     * Deletes specified setting section.
     *
     * @param SettingSection $settingSection
     * @return bool
     */
    public function deleteSection(SettingSection $settingSection): bool
    {
        if (!$settingSection->delete()) {
            throw new ModelNotDeletedException(SettingSection::class . " with id {$settingSection->id} has not been deleted");
        }

        return true;
    }

    /**
     * Finds and returns setting section using specified field.
     *
     * @param string $value
     * @param string|null $field
     * @param bool $throwIfNotFound
     * @return null|SettingSection
     * @throws Throwable
     */
    public function findSection(string $value, string $field = 'slug', bool $throwIfNotFound = true): ?SettingSection
    {
        try {
            return SettingSection::findBy($field, $value);
        } catch (\Exception $e) {
            throw_if($throwIfNotFound, ModelNotFoundException::class, ...[SettingSection::class . " with value \"{$value}\" in field {$field} has not been found."]);
            return null;
        }
    }
}
