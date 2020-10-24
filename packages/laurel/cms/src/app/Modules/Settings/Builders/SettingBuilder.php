<?php


namespace Laurel\CMS\Modules\Settings\Builders;


use Laurel\CMS\Abstracts\Field;
use Laurel\CMS\Modules\Settings\Models\Setting;
use Laurel\CMS\Modules\Settings\Models\SettingSection;

/**
 * Class for build setting object.
 *
 * Class SettingBuilder
 * @package Laurel\CMS\Modules\Settings\Builders
 */
class SettingBuilder
{
    /**
     * Creating instance of the setting.
     *
     * @var Setting|null
     */
    protected ?Setting $instance;

    /**
     * Clears current and creates new instance for build.
     *
     * @param Setting|null $setting
     * @return $this
     */
    public function make(?Setting $setting = null) : SettingBuilder
    {
        $this->instance = $setting ?? new Setting;
        return $this;
    }

    /**
     * Sets instance for build.
     *
     * @param Setting $setting
     * @return SettingBuilder $this
     */
    public function setInstance(Setting $setting) : SettingBuilder
    {
        $this->instance = $setting;
        return $this;
    }

    /**
     * Returns built instance of the setting.
     *
     * @return Setting|null
     */
    public function instance() : ?Setting
    {
        return $this->instance;
    }

    /**
     * Setter for setting name.
     *
     * @param array $name
     * @return $this
     */
    public function setName(array $name)
    {
        $this->instance->name = $name;
        return $this;
    }

    /**
     * Setter for setting description.
     *
     * @param array $description
     * @return $this
     */
    public function setDescription(array $description)
    {
        $this->instance->description = $description;
        return $this;
    }

    /**
     * Setter for setting slug.
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug(string $slug)
    {
        $this->instance->slug = $slug;
        return $this;
    }

    /**
     * Setter for setting value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->instance->value = $value;
        return $this;
    }

    /**
     * Setter for setting section.
     *
     * @param SettingSection $section
     * @return $this
     */
    public function setSection(SettingSection $section)
    {
        $this->instance->section()->associate($section);
        return $this;
    }

    /**
     * Setter for setting type.
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->instance->type = Field::getClassByType($type);
        return $this;
    }

    /**
     * Setter for setting attributes.
     *
     * @param array|null $attributes
     * @return $this
     */
    public function setAttributes(?array $attributes)
    {
        $this->instance->attributes = $attributes;
        return $this;
    }
}
