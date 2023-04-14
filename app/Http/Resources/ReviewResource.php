<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'game' => new GameResource($this->whenLoaded('game')),
            'user' => new UserResource($this->whenLoaded('user')),
            'rating' => $this->rating,
            'content' => $this->content,
        ];
    }
}
