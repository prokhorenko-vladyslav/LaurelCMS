<?php


namespace Laurel\CMS\Modules\Settings\Builders;


use Laurel\CMS\Modules\Settings\Models\SettingSection;

/**
 * Class for build setting section object.
 *
 * Class SettingBuilder
 * @package Laurel\CMS\Modules\Settings\Builders
 */
class SettingSectionBuilder
{
    /**
     * Creating instance of the setting section.
     *
     * @var SettingSection|null
     */
    protected ?SettingSection $instance;

    /**
     * Sets instance or creates new instance for build.
     *
     * @param SettingSection|null $settingSection
     * @return SettingSectionBuilder
     */
    public function make(?SettingSection $settingSection = null) : SettingSectionBuilder
    {
        $this->instance = $settingSection ?? new SettingSection;
        return $this;
    }

    /**
     * Returns built instance of the setting section.
     *
     * @return SettingSection|null
     */
    public function instance() : ?SettingSection
    {
        return $this->instance;
    }

    /**
     * Setter for setting section name.
     *
     * @param array $name
     * @return SettingSectionBuilder
     */
    public function setName(array $name) : SettingSectionBuilder
    {
        $this->instance->name = $name;
        return $this;
    }

    /**
     * Setter for setting section description.
     *
     * @param array $description
     * @return SettingSectionBuilder
     */
    public function setDescription(array $description) : SettingSectionBuilder
    {
        $this->instance->description = $description;
        return $this;
    }

    /**
     * Setter for setting section slug.
     *
     * @param string $slug
     * @return SettingSectionBuilder
     */
    public function setSlug(string $slug) : SettingSectionBuilder
    {
        $this->instance->slug = $slug;
        return $this;
    }

    /**
     * Setter for icon url of the setting section.
     *
     * @param string $iconUrl
     * @return SettingSectionBuilder
     */
    public function setIconUrl(string $iconUrl) : SettingSectionBuilder
    {
        $this->instance->icon_url = $iconUrl;
        return $this;
    }

    /**
     * Appends setting to section.
     *
     * @param SettingBuilder $settingBuilder
     * @return SettingSectionBuilder
     */
    public function addSetting(SettingBuilder $settingBuilder) : SettingSectionBuilder
    {
        $this->instance->settings()->save($settingBuilder->instance());
        return $this;
    }
}
