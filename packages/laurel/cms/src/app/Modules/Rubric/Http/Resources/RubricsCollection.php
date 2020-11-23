<?php

namespace Laurel\CMS\Modules\Rubric\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RubricsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'pages' => BrowseRubricsResource::collection($this->collection)
        ];
    }
}
