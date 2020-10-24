<?php


namespace Laurel\CMS\Modules\Settings\Models;


use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laurel\CMS\Modules\Localization\Traits\HasTranslations;

/**
 * Model for setting sections.
 *
 * Class SettingSection
 * @package Laurel\CMS\Modules\Settings\Models
 * @property int $id ID of the section
 * @property string $name Name of the section
 * @property string $description Description of the section
 * @property string $slug Slug of the section
 * @property string $icon_url Url for section icon
 */
class SettingSection extends Model
{
    use HasTranslations;

    /**
     * Model fillable attributes.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'description', 'slug', 'icon_url'
    ];

    /**
     * Model translatable attributes.
     *
     * @var array|string[]
     */
    protected array $translatable = [
        'name', 'description'
    ];

    /**
     * Relation with settings
     *
     * @return HasMany
     */
    public function settings() : HasMany
    {
        return $this->hasMany(Setting::class, 'section_id');
    }


    /**
     * Finds and returns setting section using specified field name and value.
     *
     * @param string $fieldName
     * @param string $value
     * @return Builder|Model|SettingSection
     */
    public static function findBy(string $fieldName, string $value) : SettingSection
    {
        return self::query()->where($fieldName, $value)->firstOrFail();
    }

    /**
     * Overriding of parent delete method for deleting children settings.
     *
     * @return bool|null
     * @throws Exception
     */
    public function delete()
    {
        $this->settings()->delete();
        return parent::delete();
    }

    /**
     * Overriding of parent forceDelete method for deleting children settings.
     *
     * @return bool|null
     * @throws Exception
     */
    public function forceDelete()
    {
        $this->settings()->forceDelete();
        return parent::delete();
    }
}
