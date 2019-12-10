<?php

namespace Botble\Blog\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'content'     => $this->content,
            'image'       => $this->image ? url($this->image) : null,
            'categories'  => CategoryResource::collection($this->categories),
            'tags'        => CategoryResource::collection($this->tags),
        ];
    }
}
