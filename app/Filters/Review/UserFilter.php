<?php

namespace App\Filters\Review;

use App\Dto\Review\ReviewFilterDto;
use Closure;
use Illuminate\Database\Eloquent\Builder;

final class UserFilter
{
    public function handle(Builder $query, Closure $next, ReviewFilterDto $request)
    {
        if ($request->user_id) {
            $query->where($query->qualifyColumn('user_id'), $request->user_id);
        }

        return $next($query);
    }
}
