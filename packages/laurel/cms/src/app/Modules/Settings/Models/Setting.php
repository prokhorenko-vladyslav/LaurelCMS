<?php


namespace Laurel\CMS\Modules\Settings\Models;


use Illuminate\Database\Eloquent\Model;
use Laurel\CMS\Modules\Settings\Exceptions\SettingAlreadyExistsException;
use Laurel\CMS\Modules\Settings\Exceptions\SettingNotFoundException;

class Setting extends Model
{
    protected bool $valueAsObjectIfJson = true;

    public static function getSetting(?string $group, string $name, bool $throwIfNotFound = false) : ?self
    {
        $setting = self::where('group', $group)->where('name', $name)->first();
        throw_if(!$setting && $throwIfNotFound, SettingNotFoundException::class, ...["Setting \"" . ($group ? "$group." : "") . "$name\" has not been found"]);

        return $setting;
    }

    public static function valueIsJson(string $value)
    {
        json_decode($value);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function setGroup(?string $groupName)
    {
        $this->attributes['group'] = $groupName;
        return $this;
    }

    public function setName(?string $settingName)
    {
        $this->attributes['name'] = $settingName;
        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function returnValueAsObject(bool $valueAsObjectIfJson = true)
    {
        $this->valueAsObjectIfJson = $valueAsObjectIfJson;
        return $this;
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = is_object($value) || is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value;
        return $this;
    }

    public function getValueAttribute($value)
    {
        return self::valueIsJson($value) ? json_decode($value, !$this->valueAsObjectIfJson) : $value;
    }

    public function saveOrFail(array $options = [])
    {
        $this->checkDuplicates();
        return parent::saveOrFail($options);
    }

    public function save(array $options = [])
    {
        $this->checkDuplicates();
        return parent::save($options);
    }

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
