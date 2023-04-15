<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public function handle(Builder $query, Closure $next, FilterRequest $request);
}
