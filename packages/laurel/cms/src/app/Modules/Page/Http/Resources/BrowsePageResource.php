<?php

namespace Laurel\CMS\Modules\Page\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrowsePageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'alias' => $this->alias,
            'status' => 1,
            'author' => $this->createdBy->full_name,
            'parent' => '--Nope--',
            'views' => $this->views,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
        ];
    }
}
