<?php

declare(strict_types=1);

namespace App\Sort;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class RelationCountSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property): void
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->withCount($property)
            ->orderByRaw("{$property}_count {$direction}");
    }
}
