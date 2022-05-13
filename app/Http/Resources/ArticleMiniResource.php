<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleMiniResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cover' => $this->cover_mini,
            'cover_mini' => $this->cover_mini,
            'title' => $this->title,
            'short_description' => substr($this->text, 0, 100),
            'views_count' => $this->views_count,
            'likes_count'=> $this->likes_count,
            'slug' => $this->slug,
        ];

    }
}
