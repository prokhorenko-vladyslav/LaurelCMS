<?php


namespace Laurel\CMS\Modules\Settings;

use Exception;
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
    public function setSetting(string $settingName, $value, bool $createIfNotExists = false)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name, !$createIfNotExists);

        if (!$setting) {
            return $this->createSetting($settingName, $value);
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
     * @return bool
     * @throws Throwable
     */
    public function createSetting(string $settingName, $value)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = new Setting;
        $setting->setGroup($group);
        $setting->setName($name);
        $setting->setValue($value);
        $setting->saveOrFail();

        return true;
    }

    /**
     * Sets value of setting to null.
     * If setting has not been found, SettingNotFoundException exception will be throwed
     *
     * @param string $settingName
     * @return bool
     * @throws Throwable
     */
    public function unsetSetting(string $settingName)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name, true);
        $setting->setValue(null);
        $setting->saveOrFail();

        return true;
    }

    /**
     * Removes setting from the database
     *
     * @param string $settingName
     * @return bool
     * @throws Exception|Throwable
     */
    public function forgetSetting(string $settingName)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name);
        if ($setting) {
            $setting->delete();
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
