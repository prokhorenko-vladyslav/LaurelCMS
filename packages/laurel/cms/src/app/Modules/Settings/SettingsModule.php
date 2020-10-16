<?php


namespace Laurel\CMS\Modules\Settings;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laurel\CMS\Abstracts\Module;
use Laurel\CMS\Modules\Settings\Exceptions\SettingSectionHasNotBeenDeletedNotFoundException;
use Laurel\CMS\Modules\Settings\Exceptions\SettingSectionNotFoundException;
use Laurel\CMS\Modules\Settings\Models\Setting;
use Laurel\CMS\Modules\Settings\Models\SettingSection;
use Throwable;

/**
 * Module for manipulating settings
 *
 * Class SettingsModule
 * @package Laurel\CMS\Modules\Settings
 */
class SettingsModule extends Module
{
    /**
     * SettingsModule load method
     *
     * @return bool|void
     */
    public function load()
    {
        require_once __DIR__ . '/Helpers/settings.php';
    }

    /**
     *
     */
    public function install()
    {

    }

    /**
     * Can module be forgotten or not
     *
     * @return bool
     */
    public function canBeForgotten(): bool
    {
        return false;
    }

    /**
     * Creates section with settings, if one with the same slug is not exists.
     *
     * @param array $name
     * @param array $description
     * @param string $slug
     * @param string $iconUrl
     * @return Builder|Model|SettingSection
     * @throws Throwable
     */
    public function createSettingSectionIfNotExists(array $name, array $description, string $slug, string $iconUrl) : SettingSection
    {
        try {
            return SettingSection::findBy('slug', $slug);
        } catch (ModelNotFoundException $e) {
            return $this->createSettingSection(
                $name, $description, $slug, $iconUrl
            );
        }
    }

    /**
     * Creates or update section with settings
     *
     * @param array $name
     * @param array $description
     * @param string $slug
     * @param string $iconUrl
     * @return Builder|Model|SettingSection
     * @throws Throwable
     */
    public function createOrUpdateSettingSection(array $name, array $description, string $slug, string $iconUrl) : SettingSection
    {
        try {
            return $this->updateSettingSection(
                SettingSection::findBy('slug', $slug),
                $name, $description, $iconUrl
            );
        } catch (ModelNotFoundException $e) {
            return $this->createSettingSection(
                $name, $description, $slug, $iconUrl
            );
        }
    }

    /**
     * Creates section with settings or throws Exception.
     *
     * @param SettingSection $section
     * @param array $name
     * @param array $description
     * @param string $iconUrl
     * @return Builder|Model|SettingSection
     * @throws Throwable
     */
    public function updateSettingSection(SettingSection $section, array $name, array $description, string $iconUrl) : SettingSection
    {
        $section = $section->fill([
            'name' => $name,
            'description' => $description,
            'icon_url' => $iconUrl
        ]);
        $section->saveOrFail();
        return $section;
    }

    /**
     * Creates section with settings or throws Exception.
     *
     * @param array $name
     * @param array $description
     * @param string $slug
     * @param string $iconUrl
     * @return Builder|Model|SettingSection
     * @throws Throwable
     */
    public function createSettingSection(array $name, array $description, string $slug, string $iconUrl) : SettingSection
    {
        $section = SettingSection::query()->create([
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
            'icon_url' => $iconUrl
        ]);
        $section->saveOrFail();
        return $section;
    }

    /**
     * Deletes setting section with all child settings.
     *
     * @param string $slug
     * @return bool
     * @throws Throwable
     */
    public function forgetSettingSection(string $slug)
    {
        throw_if(!SettingSection::findBy('slug', $slug)->delete(), new SettingSectionHasNotBeenDeletedNotFoundException, ["Section with slug \"{$slug}\" has not been found"]);
        return true;
    }

    /**
     * Method for fetching setting from database and returning this value.
     * If value has been saved as JSON, method will decode it and return
     * array(if $valueAsObjectIfJson set to false) or object (if $valueAsObjectIfJson set to true)
     *
     * @param string $settingName
     * @param null $defaultValue
     * @param bool $valueAsObjectIfJson
     * @return mixed|null
     * @throws Throwable
     */
    public function setting(string $settingName, $defaultValue = null, bool $valueAsObjectIfJson = true)
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $setting = Setting::getSetting($section, $name);
        return !empty($setting) ? $setting->returnValueAsObject($valueAsObjectIfJson)->value : $defaultValue;
    }

    /**
     * Method for fetching overrided setting from database for specified model and returning its value.
     * If value has been saved as JSON, method will decode it and return
     * array(if $valueAsObjectIfJson setted to false) or object (if $valueAsObjectIfJson setted to true)
     *
     * @param string $settingName
     * @param string $morphClass
     * @param int $morphId
     * @param null $defaultValue
     * @param bool $valueAsObjectIfJson
     * @return mixed|null
     * @throws Throwable
     */
    public function settingFor(string $settingName, string $morphClass, int $morphId, $defaultValue = null, bool $valueAsObjectIfJson = true)
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $setting = Setting::getSetting($section, $name);
        $overridedSetting = $setting->overrided($morphClass, $morphId)->first();
        if (!empty($overridedSetting)) {
            return $overridedSetting->returnValueAsObject($valueAsObjectIfJson)->getValue();
        } elseif (!empty($setting)) {
            return $setting->returnValueAsObject($valueAsObjectIfJson)->value;
        } else {
            return $defaultValue;
        }
    }

    /**
     * Updates value of setting.
     * If setting has not been found and parameter $createIfNotExists setted to true, setting will be created.
     * Otherwise, exception will be throwed
     *
     * @param string $settingName
     * @param $value
     * @param bool $createIfNotExists
     * @return Setting
     * @throws Throwable
     */
    public function setSetting(string $settingName, $value, bool $createIfNotExists = false) : Setting
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $setting = Setting::getSetting($section, $name, !$createIfNotExists);

        if (!$setting) {
            return $this->createSetting($settingName, $value);
        } else {
            $setting->value = $value;
            $setting->saveOrFail();

            return $setting;
        }
    }

    /**
     * Updates value of overrided setting.
     * If setting has not been found and parameter $createIfNotExists set to true, overrided setting and parent setting (if need) will be created.
     * Otherwise, exception will be throwed
     *
     * @param string $settingName
     * @param string $morphClass
     * @param int $morphId
     * @param $value
     * @param bool $createIfNotExists
     * @return Setting
     * @throws Throwable
     */
    public function setSettingFor(string $settingName, string $morphClass, int $morphId, $value, bool $createIfNotExists = false) : Setting
    {
        [$group, $name] = $this->getSectionAndSettingName($settingName);
        $setting = Setting::getSettingFor($group, $name, $morphClass, $morphId,!$createIfNotExists);

        if (!$setting) {
            return $this->createSettingFor($settingName, $morphClass, $morphId, $value);
        } else {
            $setting->value = $value;
            $setting->saveOrFail();

            return $setting;
        }
    }

    /**
     * Creates new setting and saves it to the database
     *
     * @param string $settingName
     * @param $value
     * @return Setting
     * @throws Throwable
     */
    public function createSetting(string $settingName, $value) : Setting
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $setting = new Setting;
        $setting->section()->associate($section);
        $setting->name = $name;
        $setting->value = $value;
        $setting->saveOrFail();

        return $setting;
    }

    /**
     * Creates new overrided setting and parent setting (if need) and saves it to the database
     *
     * @param string $settingName
     * @param string $morphClass
     * @param int $morphId
     * @param $value
     * @return Setting
     * @throws Throwable
     */
    public function createSettingFor(string $settingName, string $morphClass, int $morphId, $value) : Setting
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $parentSetting = Setting::getSetting($section, $name);

        if (!$parentSetting) {
            $parentSetting = $this->setSetting($settingName, $value, true);
        }

        $overridedSetting = new Setting;
        $overridedSetting->name = $name;
        $overridedSetting->value = $value;
        $overridedSetting->section()->associate($section);
        $overridedSetting->setMorphClass($morphClass);
        $overridedSetting->setMorphId($morphId);
        $overridedSetting->parent()->associate($parentSetting);
        $overridedSetting->saveOrFail();

        return $overridedSetting;
    }

    /**
     * Sets value of setting to null.
     * If setting has not been found, SettingNotFoundException exception will be throwed
     * If parameter $unsetForAllOverrided has been setted to true, values of all overrided setting for this setting would be setting to null too.
     *
     * @param string $settingName
     * @param bool $unsetForAllOverrides
     * @return bool
     * @throws Throwable
     */
    public function unsetSetting(string $settingName, bool $unsetForAllOverrides = false)
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $setting = Setting::getSetting($section, $name, true);
        $setting->value = null;
        $setting->saveOrFail();

        if ($unsetForAllOverrides) {
            $overrides = $setting->children()->get();
            foreach ($overrides as $override) {
                $override->value = null;
                $override->saveOrFail();
            }
        }

        return true;
    }

    /**
     * Sets value of overrided setting to null.
     * If setting has not been found, SettingNotFoundException exception will be throwed
     *
     * @param string $settingName
     * @param string $morphClass
     * @param int $morphId
     * @return bool
     * @throws Throwable
     */
    public function unsetSettingFor(string $settingName, string $morphClass, int $morphId)
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $setting = Setting::getSettingFor($section, $name, $morphClass, $morphId, true);
        $setting->value = null;
        $setting->saveOrFail();

        return true;
    }

    /**
     * Removes setting from the database
     * If parameter $forgetForAllOverrides has been set to true, all overrided setting for this setting would be deleted too.
     *
     * @param string $settingName
     * @param bool $forgetForAllOverrides
     * @return bool
     * @throws Throwable
     */
    public function forgetSetting(string $settingName, bool $forgetForAllOverrides = false)
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $setting = Setting::getSetting($section, $name);
        if ($setting) {
            $setting->delete();

            if ($forgetForAllOverrides) {
                $setting->children()->delete();
            }
        }

        return true;
    }

    /**
     * Removes overrided setting from the database for specified MorphClass and MorphId
     *
     * @param string $settingName
     * @param string $morphClass
     * @param int $morphId
     * @return bool
     * @throws Throwable
     */
    public function forgetSettingFor(string $settingName, string $morphClass, int $morphId)
    {
        [$section, $name] = $this->getSectionAndSettingName($settingName);
        $overridedSetting = Setting::getSettingFor($section, $name, $morphClass, $morphId);
        if ($overridedSetting) {
            $overridedSetting->delete();
        }

        return true;
    }

    /**
     * Explodes setting name by dot. If zero element exists, it will be section and other parts will be name of setting.
     * Otherwise, if count of exploded elements more than one, section name will be set as null and setting name will return untouched
     *
     * @param string $settingName
     * @return array [SettingSection $groupName, string $settingName]
     * @throws Throwable
     */
    protected function getSectionAndSettingName(string $settingName)
    {
        $settingNameParts = explode('.', $settingName);
        throw_if(count($settingNameParts) !== 2, SettingSectionNotFoundException::class, ...["Section slug has not been found in the setting next name \"{$settingName}\""]);
        $section = SettingSection::findBy('slug', $settingNameParts[0]);
        unset($settingNameParts[0]);
        $settingName = implode('.', $settingNameParts);

        return [
            $section,
            $settingName
        ];
    }
}
