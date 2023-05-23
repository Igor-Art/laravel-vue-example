<?php

namespace App\Models;

use App\Traits\Models\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'game_id',
        'user_id',
        'rating',
        'content',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
