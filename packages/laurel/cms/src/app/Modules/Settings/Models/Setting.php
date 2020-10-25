<?php


namespace Laurel\CMS\Modules\Settings\Models;

use Illuminate\Database\Eloquent\{ Builder, Model };
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laurel\CMS\Modules\Field\Models\Field;
use Laurel\CMS\Modules\Settings\Exceptions\{SettingAliasIsIncorrect, SettingAlreadyExistsException};
use Spatie\Translatable\HasTranslations;
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
 * @property SettingSection $section Setting section
 * @property int $section_id Setting section
 */
class Setting extends Model
{
    use HasTranslations;

    /**
     * Translatable attributes of the model.
     *
     * @var array|string[]
     */
    protected array $translatable = [
        'name', 'description'
    ];

    protected $appends = [
        'value'
    ];

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
        return $this->belongsTo(SettingSection::class, 'section_id');
    }

    public function field()
    {
        return $this->morphOne(Field::class, 'fieldable');
    }

    /**
     * Returns setting or throws exception.
     *
     * @param string $fieldName
     * @param string $value
     * @return Setting|null|Model
     */
    public static function findBy(string $fieldName, string $value) : Setting
    {
        return self::query()->where($fieldName, $value)->firstOrFail();
    }

    /**
     * Returns setting using its alias or throws exception.
     *
     * @param string $alias
     * @return Builder|Model|Setting
     */
    public static function findByAlias(string $alias)
    {
        [ $sectionSlug, $settingSlug ] = self::explodeAlias($alias);
        return self::query()->whereHas('section', function (Builder $sectionQuery) use ($sectionSlug) {
            $sectionQuery->where('slug', $sectionSlug);
        })->where('name', $settingSlug)->firstOrFail();
    }

    /**
     * Returns setting or throws exception.
     *
     * @param Builder $query
     * @param string $fieldName
     * @param string $value
     * @return Setting|null|Model
     */
    public function scopeFindBy(Builder $query, string $fieldName, string $value) : Setting
    {
        return $query->where($fieldName, $value)->firstOrFail();
    }

    /**
     * Returns setting using its alias or throws exception.
     *
     * @param Builder $query
     * @param string $alias
     * @return Builder|Model|Setting
     * @throws Throwable
     */
    public function scopeFindByAlias(Builder $query, string $alias)
    {
        [ $sectionSlug, $settingSlug ] = self::explodeAlias($alias);
        return $query->whereHas('section', function (Builder $sectionQuery) use ($sectionSlug) {
            $sectionQuery->where('slug', $sectionSlug);
        })->where('name', $settingSlug)->firstOrFail();
    }

    /**
     * Explodes alias to section slug and setting slug
     *
     * @param string $alias
     * @return array
     * @throws Throwable
     */
    protected static function explodeAlias(string $alias) : array
    {
        $parts = explode('.', $alias);
        throw_if(count($parts) !== 2, SettingAliasIsIncorrect::class, ...["Setting alias \"{$alias}\" is invalid"]);
        return $parts;
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
        if ($this->field) {
            $this->field->value = is_object($value) || is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value;
        }
        return $this;
    }

    /**
     * Mutator of the value attribute.
     * If value seems like json, it will be decoded. Otherwise, it will be returned untouched
     *
     * @param $value
     * @return mixed
     */
    public function getValueAttribute()
    {
        if ($this->field) {
            return valueIsJson($this->field->value) ? json_decode($this->field->value, !$this->valueAsObjectIfJson) : $this->field->value;
        } else {
            return null;
        }
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
        if ($this->field) {
            $this->field->save();
        }
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
        if ($this->field) {
            $this->field->save();
        }
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
                self::query()->where('section_id', $this->section->id)->where('slug', $this->slug)->exists(),
                SettingAlreadyExistsException::class,
                ...["Setting \"$this->name\" already exists in section \"{$this->section->name}\""]);
        }
    }
}
