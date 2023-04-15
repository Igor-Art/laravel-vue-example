<?php

namespace App\Traits\Models;

use App\Filters\FilterPipeline;
use App\Filters\FilterRequest;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, FilterRequest $request, array $filters): Builder
    {
        return app(FilterPipeline::class)
            ->setRequest($request)
            ->send($query)
            ->through($filters)
            ->thenReturn();
    }
}
