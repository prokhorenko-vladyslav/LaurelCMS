<?php


namespace Laurel\CMS\Modules\Field\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->simple_type,
            'positions' => $this->positions,
            'order' => $this->order,
            'attributes' => $this->attributes,
        ];
    }
}
