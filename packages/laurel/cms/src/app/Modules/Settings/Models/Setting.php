<?php


namespace Laurel\CMS\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Laurel\CMS\Modules\Settings\Exceptions\SettingAlreadyExistsException;
use Laurel\CMS\Modules\Settings\Exceptions\SettingNotFoundException;
use Laurel\CMS\Modules\Settings\Traits\CanBeOverrided;
use Throwable;

/**
 * Setting model
 *
 * Class Setting
 * @package Laurel\CMS\Modules\Settings\Models
 */
class Setting extends Model
{
    use CanBeOverrided;

    /**
     * Return setting value as object (true) or as array (false)
     *
     * @var bool
     */
    protected bool $valueAsObjectIfJson = true;

    /**
     * Return object of the setting. If it has not been found, exception SettingNotFoundException will be throwed
     *
     * @param string|null $group
     * @param string $name
     * @param bool $throwIfNotFound
     * @return static|null
     * @throws Throwable
     */
    public static function getSetting(?string $group, string $name, bool $throwIfNotFound = false) : ?self
    {
        $setting = self::where('group', $group)->where('name', $name)->whereNull('setting_id')->first();
        throw_if(!$setting && $throwIfNotFound, SettingNotFoundException::class, ...["Setting \"" . ($group ? "$group." : "") . "$name\" has not been found"]);

        return $setting;
    }

    /**
     * Return object of the overrided setting. If it has not been found, exception SettingNotFoundException will be throwed
     *
     * @param string|null $group
     * @param string $name
     * @param string $morphClass
     * @param int $morphId
     * @param bool $throwIfNotFound
     * @return static|null
     * @throws Throwable
     */
    public static function getSettingFor(?string $group, string $name, string $morphClass, int $morphId, bool $throwIfNotFound = false) : ?self
    {
        $overridedSetting = self::where('group', $group)->where('name', $name)->overrided($morphClass, $morphId)->first();
        throw_if(!$overridedSetting && $throwIfNotFound, SettingNotFoundException::class, ...["Setting \"" . ($group ? "$group." : "") . "$name\" has not been found"]);

        return $overridedSetting;
    }

    /**
     * Sets group of the setting
     *
     * @param string|null $groupName
     * @return $this
     */
    public function setGroup(?string $groupName)
    {
        $this->attributes['group'] = $groupName;
        return $this;
    }

    /**
     * Sets name of the setting
     *
     * @param string|null $settingName
     * @return $this
     */
    public function setName(?string $settingName)
    {
        $this->attributes['name'] = $settingName;
        return $this;
    }

    /**
     * Sets value of the setting
     *
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Returns value of the setting
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Method for changing returning type of the value.
     * If $valueAsObjectIfJson setted to true, object will be returned. Otherwise, method will return array
     *
     * @param bool $valueAsObjectIfJson
     * @return $this
     */
    public function returnValueAsObject(bool $valueAsObjectIfJson = true)
    {
        $this->valueAsObjectIfJson = $valueAsObjectIfJson;
        return $this;
    }

    /**
     * Sets setting value.
     * If it is object or array, it will be decoded as json. If it is string or number, value will be saved to the database untouched
     *
     * @param $value
     * @return $this
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = is_object($value) || is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value;
        return $this;
    }

    /**
     * Mutator of the value attribute.
     * If value seems like json, it will be decoded. Otherwise, it will be returned untouched
     *
     * @param $value
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        return valueIsJson($value) ? json_decode($value, !$this->valueAsObjectIfJson) : $value;
    }

    /**
     * Overriding of the default method saveOrFail of the Laravel model.
     * Before save method checks if setting with same group and name already exists in the database.
     * If does, exception SettingAlreadyExistsException will be throwed
     *
     * @param array $options
     * @return bool
     * @throws Throwable
     */
    public function saveOrFail(array $options = [])
    {
        $this->checkDuplicates();
        return parent::saveOrFail($options);
    }

    /**
     * Overriding of the default method save of the Laravel model.
     * Before save method checks if setting with same group and name already exists in the database.
     * If does, exception SettingAlreadyExistsException will be throwed
     * @param array $options
     * @return bool
     * @throws Throwable
     */
    public function save(array $options = [])
    {
        $this->checkDuplicates();
        return parent::save($options);
    }

    /**
     * Before save method checks if setting with same group and name already exists in the database.
     * If does, exception SettingAlreadyExistsException will be throwed
     * @throws Throwable
     */
    public function checkDuplicates()
    {
        if (!$this->exists) {
            throw_if(
                $this->isOverriding ? self::getSettingFor($this->group, $this->name, $this->getMorphClass(), $this->getMorphId()) : self::getSetting($this->group, $this->name),
                SettingAlreadyExistsException::class,
                ...["Setting \"$this->name\" already exists " . ($this->group ? "in group \"{$this->group}\"" : "")]);
        }
    }
}
