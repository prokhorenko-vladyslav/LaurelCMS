<?php


namespace Laurel\CMS\Modules\Settings\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prophecy\Exception\Doubler\ClassNotFoundException;
use Throwable;

/**
 * Trait for manipulating of overrided settings
 *
 * Trait OverridedSetting
 * @package Laurel\CMS\Modules\Settings\Models
 */
trait CanBeOverrided
{
    /**
     * Parameter, which shows setting is override or not
     *
     * @var bool
     */
    protected bool $isOverriding = false;

    /**
     * Mutator for settingable_type attribute
     *
     * @param string $morphClass
     * @throws Throwable
     */
    public function setSettingableTypeAttribute(string $morphClass)
    {
        throw_if(!class_exists($morphClass), ClassNotFoundException::class, ...["Class \"" . $morphClass . "\" has not been founded"]);
        $this->isOverriding = true;
        $this->attributes['settingable_type'] = $morphClass;
    }

    /**
     * Setter for override MorphClass
     *
     * @param string $morphClass
     */
    public function setMorphClass(string $morphClass)
    {
        $this->settingable_type = $morphClass;
    }

    /**
     * Mutator for settingable_id attribute
     *
     * @param string $morphId
     */
    public function setSettingableIdAttribute(string $morphId)
    {
        $this->isOverriding = true;
        $this->attributes['settingable_id'] = $morphId;
    }

    /**
     * Setter for override MorphId
     *
     * @param int $morphId
     */
    public function setMorphId(int $morphId)
    {
        $this->settingable_id = $morphId;
    }

    /**
     * Parent relation for overrided setting
     *
     * @return BelongsTo
     */
    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class, 'setting_id');
    }

    /**
     * Children relation for setting
     *
     * @return HasMany
     */
    public function children() : HasMany
    {
        return $this->hasMany(self::class, 'setting_id');
    }

    /**
     * Getter for overriding MorphClass
     *
     * @return mixed
     */
    public function getMorphClass()
    {
        return $this->attributes['settingable_type'];
    }

    /**
     * Getter for overriding MorphId
     *
     * @return mixed
     */
    public function getMorphId()
    {
        return $this->attributes['settingable_id'];
    }

    /**
     * Overrided scope, which add conditions for fetching setting with specified MorphClass and MorphId
     *
     * @param Builder $query
     * @param string $morphClass
     * @param string $morphId
     * @return Builder
     */
    public static function scopeOverrided(Builder $query, string $morphClass, string $morphId) : Builder
    {
        return $query
                ->where('settingable_type', $morphClass)
                ->where('settingable_id', $morphId);
    }
}
