<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'full_link' => $this->full_link,
            'cover_url' => $this->cover_url,
            'year' => $this->year,
            'rating' => $this->rating,
            'price' => $this->price,
            'description' => $this->description,
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
        ];
    }
}
