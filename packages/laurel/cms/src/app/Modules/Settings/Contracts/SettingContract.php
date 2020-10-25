<?php


namespace Laurel\CMS\Modules\Settings\Contracts;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laurel\CMS\Modules\Settings\Builders\SettingBuilder;
use Laurel\CMS\Modules\Settings\Models\Setting;
use Throwable;

/**
 * Contract for manipulating of settings.
 *
 * Interface SettingContract
 * @package Laurel\CMS\Modules\Settings\Contracts
 */
interface SettingContract
{
    /**
     * Creates new setting.
     *
     * @param SettingBuilder $settingBuilder
     * @return Setting
     */
    public function create(SettingBuilder $settingBuilder) : Setting;

    /**
     * Updates specified setting.
     *
     * @param SettingBuilder $settingBuilder
     * @return Setting
     */
    public function update(SettingBuilder $settingBuilder) : Setting;

    /**
     * Deletes specified setting.
     *
     * @param Setting $setting
     * @return bool
     */
    public function delete(Setting $setting) : bool;

    /**
     * Finds and returns setting using specified field.
     *
     * @param string $value
     * @param string|null $field
     * @return null|Setting
     */
    public function find(string $value, string $field = 'slug') : ?Setting;

    /**
     * Finds setting by alias and returns its value or returns default value.
     *
     * @param string $alias
     * @param $defaultValue
     * @return mixed
     * @throws Throwable
     */
    public function findOrDefault(string $alias, $defaultValue);

    /**
     * Finds and returns setting using its alias.
     *
     * @param string $alias
     * @param bool $throwIfNotFound
     * @return Builder|Model|null|Setting
     * @throws Throwable
     */
    public function findByAlias(string $alias, bool $throwIfNotFound = true);
}
