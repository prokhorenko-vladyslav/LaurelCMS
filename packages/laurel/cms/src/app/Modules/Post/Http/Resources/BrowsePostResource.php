<?php

namespace Laurel\CMS\Modules\Post\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrowsePostResource extends JsonResource
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
            'title' => $this->title,
            'alias' => $this->alias,
            'status' => 1,
            'author' => $this->createdBy->full_name,
            'parent' => '--Nope--',
            'views' => $this->views,
            'createdUpdatedAt' => $this->created_at->format('d.m.Y H:i:s') . "/" . $this->updated_at->format('d.m.Y H:i:s'),
        ];
    }
}
