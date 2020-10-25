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
            "name" => $this->name,
            "description" => $this->description,
            "slug" => $this->slug,
            "value" => $this->getValueTranslations(),
            "field" => new FieldResource($this->field)
        ];
    }
}
