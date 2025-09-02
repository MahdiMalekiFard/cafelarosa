<?php

declare(strict_types=1);

namespace App\Yajra\Filter;

class CategoriesTitleFilter implements FilterContract
{
    public function __invoke($query, $keyword): void
    {
        if ( ! empty($keyword)) {
            $query->whereHas('categories.translations', function ($query) use ($keyword) {
                $query
//                    ->where('key', 'title')
                    ->where('value', 'like', '%' . $keyword . '%');
            });
        }
    }
}
