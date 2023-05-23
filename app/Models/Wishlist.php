<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'game_id',
        'user_id',
    ];
}
