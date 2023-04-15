<?php

namespace App\Filters\Review;

use App\Filters\Filter;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class GameFilter implements Filter
{
    public function handle(Builder $query, Closure $next, $request)
    {
        if ($request->game_id) {
            $query->where($query->qualifyColumn('game_id'), $request->game_id);
        }

        return $next($query);
    }
}
