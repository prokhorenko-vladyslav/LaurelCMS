<?php

namespace Laurel\CMS\Modules\Page\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PagesCollection extends ResourceCollection
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
            'pages' => BrowsePageResource::collection($this->collection)
        ];
    }
}
