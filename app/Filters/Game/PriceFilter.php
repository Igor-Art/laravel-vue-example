<?php

namespace App\Filters\Game;

use App\Filters\Filter;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class PriceFilter implements Filter
{
    public function handle(Builder $query, Closure $next, $request)
    {
        if ($request->is_free) {
            $query->whereNull($query->qualifyColumn('price'));
        }

        return $next($query);
    }
}
