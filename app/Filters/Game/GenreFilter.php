<?php

namespace App\Filters\Game;

use App\Filters\Filter;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class GenreFilter implements Filter
{
    public function handle(Builder $query, Closure $next, $request)
    {
        if ($request->genres) {
            //
        }

        return $next($query);
    }
}
