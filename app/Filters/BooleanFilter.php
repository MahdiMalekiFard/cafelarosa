<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class BooleanFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        return $query->where($property, $value);
    }
}
