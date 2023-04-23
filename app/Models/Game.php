<?php

namespace App\Models;

use App\Services\Currency\Currency;
use App\Traits\Models\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Game extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'slug',
        'cover',
        'year',
        'description',
        'rating',
        'price',
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function userWishlist()
    {
        return $this->hasOne(Wishlist::class);
    }

    protected function fullLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route('games.show', $this->slug),
        );
    }

    protected function coverUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk(static::class)->url($this->cover),
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? Currency::make($value) : null,
        );
    }
}
