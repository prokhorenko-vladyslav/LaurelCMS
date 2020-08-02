<?php


namespace Laurel\CMS\Modules\Settings;

use Laurel\CMS\Abstracts\Module;
use Laurel\CMS\Modules\Settings\Models\Setting;

class SettingsModule extends Module
{
    public function load()
    {
        require_once __DIR__ . '/Helpers/settings.php';
    }

    public function canBeForgotten(): bool
    {
        return false;
    }

    public function setting(string $settingName, $defaultValue = null, bool $valueAsObjectIfJson = true)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name);
        return !empty($setting) ? $setting->returnValueAsObject($valueAsObjectIfJson)->getValue() : $defaultValue;
    }

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

    public function unsetSetting(string $settingName)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name, true);
        $setting->setValue(null);
        $setting->saveOrFail();

        return true;
    }

    public function forgetSetting(string $settingName)
    {
        [$group, $name] = $this->getGroup($settingName);
        $setting = Setting::getSetting($group, $name);
        if ($setting) {
            $setting->delete();
        }

        return true;
    }

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
