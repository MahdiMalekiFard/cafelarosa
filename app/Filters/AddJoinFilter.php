<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class AddJoinFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        if (is_array($value)) {
            $eloquent = $query->getModel();
            $table    = $eloquent->getTable();
            foreach ($value as $item) {
                $query->when(str_contains(request('sort'), $item), function ($q) use ($eloquent, $table, $item) {
                    if ($item === 'translations') {
                        $q->select(['*', "{$table}.id as id"])
                            ->join($item, "{$table}.id", '=', "{$item}.translatable_id")
                            ->where("{$item}.translatable_type", $eloquent::class)
                            ->where("{$item}.locale", app()->getLocale());
                    } else {
                        $q->select(["{$table}.*", "{$table}.id as id"])
                            ->join($item, "{$table}.id", '=', "{$item}.id");
                    }
                });
            }
        }
    }
}
