<?php


namespace Laurel\CMS\Modules\Field\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laurel\CMS\Modules\Field\Contracts\FieldModuleContract;
use Spatie\Translatable\HasTranslations;

class Field extends Model
{
    use HasTranslations;

    protected $fillable = [
        'type', 'order', 'attributes', 'value', 'positions'
    ];

    protected $casts = [
        'attributes' => 'array',
        'positions' => 'collection'
    ];

    protected $appends = [
        'simple_type'
    ];

    public $translatable = [

    ];

    public function fieldable()
    {
        return $this->morphTo('fieldable');
    }

    public function setTypeAttribute(string $type)
    {
        cms()->module(FieldModuleContract::class)->getClassByType($type);
        $this->attributes['type'] = $type;
        return $this;
    }

    public function getTypeAttribute()
    {
        return cms()->module(FieldModuleContract::class)->getClassByType($this->attributes['type']);
    }

    public function getSimpleTypeAttribute() : ?string
    {
        return $this->attributes['type'];
    }

    public function save(array $options = [])
    {
        $this->positions->transform(function ($item) {
            $item['name'] = Str::lower($item['name']);
            return $item;
        });
        return parent::save($options);
    }

    public function saveOrFail(array $options = [])
    {
        $this->positions->transform(function ($item) {
            $item['name'] = Str::lower($item['name']);
            return $item;
        });
        return parent::saveOrFail($options);
    }
}
