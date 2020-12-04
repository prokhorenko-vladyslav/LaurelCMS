<?php

namespace Laurel\CMS\Modules\Rubric\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RubricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
