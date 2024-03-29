<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'verified' => (bool) $this->email_verified_at,
            'registered_at' => $this->created_at,
            'two_factor_enabled' => $this->two_factor_secret !== null,
        ];
    }
}
