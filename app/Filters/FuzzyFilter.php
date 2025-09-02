<?php

declare(strict_types=1);

namespace App\Filters;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FuzzyFilter implements Filter
{
    private array $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function __invoke(Builder $query, $value, string $property): void
    {
        $value = StringHelper::enNum($value);
        $query->where(function ($q) use ($value) {
            $first_check = false;
            foreach ($this->params as $index => $param) {
                if (is_array($param)) {
                    if ( ! $first_check) {
                        $first_check = true;
                        $q->whereHas($index, function ($q) use ($param, $value) {
                            foreach ($param as $index => $p) {
                                if ($index === 0) {
                                    $q->where($q->getModel()->getTable() . '.' . $p, 'LIKE', '%' . $value . '%');
                                } else {
                                    $q->orWhere($q->getModel()->getTable() . '.' . $p, 'LIKE', '%' . $value . '%');
                                }
                            }
                        });
                    } else {
                        $q->orWhereHas($index, function ($q) use ($param, $value) {
                            foreach ($param as $index => $p) {
                                if ($index === 0) {
                                    $q->where($q->getModel()->getTable() . '.' . $p, 'LIKE', '%' . $value . '%');
                                } else {
                                    $q->orWhere($q->getModel()->getTable() . '.' . $p, 'LIKE', '%' . $value . '%');
                                }
                            }
                        });
                    }
                } else {
                    if ( ! $first_check) {
                        $first_check = true;
                        $q->where(function (Builder $q2) use ($param, $value) {
                            $q2->where($q2->getModel()->getTable() . '.' . $param, 'LIKE', '%' . $value . '%');
                        });
                    } else {
                        $q->orWhere(function ($q2) use ($param, $value) {
                            $q2->where($q2->getModel()->getTable() . '.' . $param, 'LIKE', '%' . $value . '%');
                        });
                    }
                }
            }
        });
    }
}
