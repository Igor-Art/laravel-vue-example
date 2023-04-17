<?php

namespace App\Filters\Game;

use App\Filters\Filter;
use Closure;
use Illuminate\Database\Eloquent\Builder;

final class GenreFilter implements Filter
{
    public function handle(Builder $query, Closure $next, $request)
    {
        if ($request->genres) {
            $query->whereHas(
                'genres',
                static fn ($query) => $query->whereIn($query->qualifyColumn('id'), $request->genres)
            );
        }

        return $next($query);
    }
}
