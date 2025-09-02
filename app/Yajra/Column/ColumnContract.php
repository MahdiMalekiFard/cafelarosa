<?php

declare(strict_types=1);

namespace App\Yajra\Column;

interface ColumnContract
{
    public function __invoke($row);
}
