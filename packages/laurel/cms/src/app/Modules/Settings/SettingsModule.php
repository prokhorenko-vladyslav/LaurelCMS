<?php


namespace Laurel\CMS\Modules\Settings;

use Laurel\CMS\Abstracts\Module;
use Laurel\CMS\Modules\Settings\Models\Setting;
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
     * Can module be forgetten or not
     *
     * @return bool
     */
    public function canBeForgotten(): bool
    {
        return false;
    }

    /**
     * Method for fetching setting from database and returning its value.
     * If value has been saved as JSON, method will decode it and return
     * array(if $valueAsObjectIfJson setted to false) or object (if $valueAsObjectIfJson setted to true)
     *
     * @param string $settingName
     * @param null $defaultValue
     * @param bool $valueAsObjectIfJson
     * @return mixed|null
     * @throws Throwable
     */
    public function setting(string $settingName, $defaultValue = null, bool $valueAsObjectIfJson = true)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name);
        return !empty($setting) ? $setting->returnValueAsObject($valueAsObjectIfJson)->getValue() : $defaultValue;
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
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name);
        $overridedSetting = $setting->overrided($morphClass, $morphId)->first();
        if (!empty($overridedSetting)) {
            return $overridedSetting->returnValueAsObject($valueAsObjectIfJson)->getValue();
        } elseif (!empty($setting)) {
            return $setting->returnValueAsObject($valueAsObjectIfJson)->getValue();
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
     * @return bool
     * @throws Throwable
     */
    public function setSetting(string $settingName, $value, bool $createIfNotExists = false) : Setting
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name, !$createIfNotExists);

        if (!$setting) {
            return $this->createSetting($settingName, $value);
        } else {
            $setting->setValue($value);
            $setting->saveOrFail();

            return $setting;
        }
    }

    /**
     * Updates value of overrided setting.
     * If setting has not been found and parameter $createIfNotExists setted to true, overrided setting and parent setting (if need) will be created.
     * Otherwise, exception will be throwed
     *
     * @param string $settingName
     * @param string $morphClass
     * @param int $morphId
     * @param $value
     * @param bool $createIfNotExists
     * @return bool
     * @throws Throwable
     */
    public function setSettingFor(string $settingName, string $morphClass, int $morphId, $value, bool $createIfNotExists = false)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSettingFor($group, $name, $morphClass, $morphId,!$createIfNotExists);

        if (!$setting) {
            return $this->createSettingFor($settingName, $morphClass, $morphId, $value);
        } else {
            $setting->setValue($value);
            $setting->saveOrFail();

            return true;
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
        [$group, $name] = $this->getGroup($settingName);
        $setting = new Setting;
        $setting->setGroup($group);
        $setting->setName($name);
        $setting->setValue($value);
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
        [$group, $name] = $this->getGroup($settingName);
        $parentSetting = Setting::getSetting($group, $name);

        if (!$parentSetting) {
            $parentSetting = $this->setSetting($settingName, $value, true);
        }

        $overridedSetting = new Setting;
        $overridedSetting->setGroup($group);
        $overridedSetting->setName($name);
        $overridedSetting->setValue($value);
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
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name, true);
        $setting->setValue(null);
        $setting->saveOrFail();

        if ($unsetForAllOverrides) {
            $overrides = $setting->children()->get();
            foreach ($overrides as $override) {
                $override->setValue(null);
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
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSettingFor($group, $name, $morphClass, $morphId, true);
        $setting->setValue(null);
        $setting->saveOrFail();

        return true;
    }

    /**
     * Removes setting from the database
     * If parameter $forgetForAllOverrides has been setted to true, all overrided setting for this setting would be deleted too.
     *
     * @param string $settingName
     * @param bool $forgetForAllOverrides
     * @return bool
     * @throws Throwable
     */
    public function forgetSetting(string $settingName, bool $forgetForAllOverrides = false)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name);
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
        [$group, $name] = $this->getGroup($settingName);
        $overridedSetting = Setting::getSettingFor($group, $name, $morphClass, $morphId);
        if ($overridedSetting) {
            $overridedSetting->delete();
        }

        return true;
    }

    /**
     * Explodes setting name by dot. If zero element exists, it will be group and other parts will be name of setting.
     * Otherwise, if count of exploded elements more than one, group name will be setted as null and setting name will return untouched
     *
     * @param string $settingName
     * @return array [groupName, settingName]
     */
    protected function getGroup(string $settingName)
    {
        $groupName = null;
        $settingNameParts = explode('.', $settingName);
        if (count($settingNameParts) > 1) {
            $groupName = $settingNameParts[0];
            unset($settingNameParts[0]);
            $settingName = implode('.', $settingNameParts);
        }

        return [
            $groupName,
            $settingName
        ];
    }
}
