<?php


namespace Laurel\CMS\Modules\Settings\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Laurel\CMS\Modules\Field\Http\Resources\FieldResource;

class SettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->getTranslations('name'),
            "description" => $this->getTranslations('description'),
            "slug" => $this->slug,
            "value" => $this->value,
            "field" => new FieldResource($this->whenLoaded('field'))
        ];
    }
}
