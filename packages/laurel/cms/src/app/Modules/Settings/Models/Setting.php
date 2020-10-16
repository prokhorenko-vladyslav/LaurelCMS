<?php


namespace Laurel\CMS\Modules\Settings\Models;

use Illuminate\Database\Eloquent\{ Builder, Collection, Model };
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laurel\CMS\Modules\Settings\Exceptions\{ SettingAlreadyExistsException, SettingNotFoundException };
use Laurel\CMS\Modules\Settings\Traits\CanBeOverrided;
use Throwable;

/**
 * Setting model
 *
 * Class Setting
 * @package Laurel\CMS\Modules\Settings\Models
 * @property int $id ID of the setting
 * @property string $name Display name of the setting
 * @property string $description Description of the setting
 * @property string $slug Slug of the setting
 * @property string|array|null $value Value of the setting
 * @property string $type Type of the setting
 * @property array|null $attributes Attributes of the setting
 * @property Setting|null $setting Parent setting, which has been overrided
 * @property SettingSection $section Setting section
 * @property int $section_id Setting section
 * @property int $settingable_id ID of the morph object
 * @property string $settingable_type Class of the morph object
 * @property Setting $parent Overrided setting
 * @property Setting[]|Collection $children Collection with setting overriding
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
     * Relation with setting section
     *
     * @return BelongsTo
     */
    public function section() : BelongsTo
    {
        return $this->belongsTo(SettingSection::class);
    }

    /**
     * Return object of the setting. If it has not been found, exception SettingNotFoundException will be throwed
     *
     * @param string $section
     * @param string $name
     * @param bool $throwIfNotFound
     * @return static|null
     * @throws Throwable
     */
    public static function getSetting(string $section, string $name, bool $throwIfNotFound = false) : ?self
    {
        $setting = self::whereHas('section', function (Builder $sectionQuery) use ($section) {
            $sectionQuery->where('slug', $section);
        })->where('name', $name)->whereNull('setting_id')->first();
        throw_if(!$setting && $throwIfNotFound, SettingNotFoundException::class, ...["Setting \"{$section}.{$name}\" has not been found"]);

        return $setting;
    }

    /**
     * Return object of the overrided setting. If it has not been found, exception SettingNotFoundException will be throwed
     *
     * @param string $section
     * @param string $name
     * @param string $morphClass
     * @param int $morphId
     * @param bool $throwIfNotFound
     * @return static|null
     * @throws Throwable
     */
    public static function getSettingFor(string $section, string $name, string $morphClass, int $morphId, bool $throwIfNotFound = false) : ?self
    {
        $overridedSetting = self::whereHas('section', function (Builder $sectionQuery) use ($section) {
            $sectionQuery->where('slug', $section);
        })->where('name', $name)->overrided($morphClass, $morphId)->first();
        throw_if(!$overridedSetting && $throwIfNotFound, SettingNotFoundException::class, ...["Setting \"{$section}.{$name}\" has not been found"]);

        return $overridedSetting;
    }

    /**
     * Method for changing returning type of the value.
     * If $valueAsObjectIfJson set to true, object will be returned. Otherwise, method will return array
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
     * Before save method checks if setting with same section and name already exists in the database.
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
     * Before save method checks if setting with same section and name already exists in the database.
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
     * Before save method checks if setting with same section and name already exists in the database.
     * If does, exception SettingAlreadyExistsException will be throwed
     * @throws Throwable
     */
    public function checkDuplicates()
    {
        if (!$this->exists) {
            throw_if(
                $this->isOverriding ? self::getSettingFor($this->section->name, $this->name, $this->getMorphClass(), $this->getMorphId()) : self::getSetting($this->section->name, $this->name),
                SettingAlreadyExistsException::class,
                ...["Setting \"$this->name\" already exists in section \"{$this->section->name}\""]);
        }
    }
}
