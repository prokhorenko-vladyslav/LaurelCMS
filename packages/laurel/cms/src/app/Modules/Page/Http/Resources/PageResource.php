<?php

namespace Laurel\CMS\Modules\Page\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            'seo_keywords' => $this->seo_keywords,
            'seo_robots_txt' => $this->seo_robots_txt,
            'text' => $this->text
        ];
    }
}
