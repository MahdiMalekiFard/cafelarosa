<?php

declare(strict_types=1);

namespace App\Yajra\Column;

use Illuminate\Support\Str;

class TitleColumn implements ColumnContract
{
    public function __invoke($row): string
    {
        return Str::limit($row->title, 50) ?: '---';
    }
}
