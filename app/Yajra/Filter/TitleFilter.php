<?php

declare(strict_types=1);

namespace App\Yajra\Filter;

class TitleFilter implements FilterContract
{
    public function __invoke($query, $keyword): void
    {
        if ( ! empty($keyword)) {
            $query->whereHas('translations', function ($query) use ($keyword) {
                $query
                    ->where('key', 'title')
                    ->where('value', 'like', '%' . $keyword . '%');
            });
        }
    }
}
