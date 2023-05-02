<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'game' => new GameResource($this->whenLoaded('game')),
            'user' => new UserResource($this->whenLoaded('user')),
            'rating' => $this->rating,
            'content' => $this->content,
            'published_at' => $this->created_at,
        ];
    }
}
