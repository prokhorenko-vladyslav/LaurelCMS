<?php


namespace Laurel\CMS\Modules\Settings\Contracts;


use Laurel\CMS\Modules\Settings\Builders\SettingSectionBuilder;
use Laurel\CMS\Modules\Settings\Models\SettingSection;

/**
 * Contract for manipulating of setting section
 *
 * Interface SettingSectionContract
 * @package Laurel\CMS\Modules\Settings\Contracts
 */
interface SettingSectionContract
{
    /**
     * Creates new setting section.
     *
     * @param SettingSectionBuilder $settingSectionBuilder
     * @return SettingSection
     */
    public function createSection(SettingSectionBuilder $settingSectionBuilder) : SettingSection;

    /**
     * Updates specified setting section.
     *
     * @param SettingSectionBuilder $settingSectionBuilder
     * @return SettingSection
     */
    public function updateSection(SettingSectionBuilder $settingSectionBuilder) : SettingSection;

    /**
     * Deletes specified setting section.
     *
     * @param SettingSection $settingSection
     * @return bool
     */
    public function deleteSection(SettingSection $settingSection) : bool;

    /**
     * Finds and returns setting section using specified field.
     *
     * @param string $value
     * @param string|null $field
     * @param bool $throwIfNotFound
     * @return null|SettingSection
     */
    public function findSection(string $value, string $field = 'slug', bool $throwIfNotFound = true) : ?SettingSection;
}
