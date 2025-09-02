<?php

declare(strict_types=1);

namespace App\Yajra\Column;

use App\Helpers\DatatableHelper;

class PublishedColumn implements ColumnContract
{
    public function __invoke($row): string
    {
        return DatatableHelper::published($row->published);
    }
}
