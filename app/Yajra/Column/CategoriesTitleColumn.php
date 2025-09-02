<?php

declare(strict_types=1);

namespace App\Yajra\Column;

use Illuminate\Support\Str;

class CategoriesTitleColumn implements ColumnContract
{
    public function __invoke($row): string
    {
        return Str::limit($row->categories_title, 50) ?: '---';
    }
}
