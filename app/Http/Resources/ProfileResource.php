<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $request->user() ? $this->email : null,
            'verified' => (bool) $this->email_verified_at,
            'registered_at' => $this->created_at,
            'reviews_count' => $this->reviews_count,
            'wishlist_count' => $this->wishlist_count,
        ];
    }
}
