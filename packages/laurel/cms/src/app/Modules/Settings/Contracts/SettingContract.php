<?php


namespace Laurel\CMS\Modules\Settings\Contracts;


use Laurel\CMS\Modules\Settings\Builders\SettingBuilder;
use Laurel\CMS\Modules\Settings\Models\Setting;

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
}
