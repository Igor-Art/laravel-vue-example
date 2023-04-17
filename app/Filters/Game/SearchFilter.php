<?php

namespace App\Filters\Game;

use App\Filters\Filter;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter implements Filter
{
    public function handle(Builder $query, Closure $next, $request)
    {
        if ($request->search) {
            //
        }

        return $next($query);
    }
}
