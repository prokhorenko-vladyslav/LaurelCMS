<?php


namespace Laurel\CMS\Modules\Field\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class FieldResource extends JsonResource
{
    public function toArray($request)
    {
        $attributes = $this->translatePlaceholderIfExists();
        return [
            'id' => $this->id,
            'type' => $this->simple_type,
            'studlyType' => Str::studly($this->simple_type),
            'positions' => $this->positions,
            'order' => $this->order,
            'attributes' => $attributes,
        ];
    }

    protected function translatePlaceholderIfExists()
    {
        $attributes = $this->attributes;
        if (
            !empty($this->attributes['placeholder']) &&
            !empty($this->attributes['placeholder'][App::getLocale()]) &&
            (
                is_array($this->attributes['placeholder']) ||
                is_object($this->attributes['placeholder'])
            )
        ) {
            $attributes['placeholder'] = $this->attributes['placeholder'][App::getLocale()];
        }

        return $attributes;
    }
}
