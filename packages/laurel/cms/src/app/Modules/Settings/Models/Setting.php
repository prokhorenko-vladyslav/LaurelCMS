<?php


namespace Laurel\CMS\Modules\Settings\Models;


use Illuminate\Database\Eloquent\Model;
use Laurel\CMS\Modules\Settings\Exceptions\SettingAlreadyExistsException;
use Laurel\CMS\Modules\Settings\Exceptions\SettingNotFoundException;
use Throwable;

/**
 * Setting model
 *
 * Class Setting
 * @package Laurel\CMS\Modules\Settings\Models
 */
class Setting extends Model
{
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
        $setting = self::where('group', $group)->where('name', $name)->first();
        throw_if(!$setting && $throwIfNotFound, SettingNotFoundException::class, ...["Setting \"" . ($group ? "$group." : "") . "$name\" has not been found"]);

        return $setting;
    }

    /**
     * Checks value and return true, if it seems like json
     *
     * @param string $value
     * @return bool
     */
    public static function valueIsJson(string $value)
    {
        json_decode($value);
        return (json_last_error() == JSON_ERROR_NONE);
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
        return self::valueIsJson($value) ? json_decode($value, !$this->valueAsObjectIfJson) : $value;
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
                self::getSetting($this->group, $this->name),
                SettingAlreadyExistsException::class,
                ...["Setting \"$this->name\" already exists " . ($this->group ? "in group \"{$this->group}\"" : "")]);
        }
    }
}
