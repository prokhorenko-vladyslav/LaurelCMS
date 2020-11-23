<?php

namespace Laurel\CMS\Modules\Post\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostsCollection extends ResourceCollection
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
            'pages' => BrowseRubricResource::collection($this->collection)
        ];
    }
}
