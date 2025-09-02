<?php

declare(strict_types=1);

namespace App\Yajra\Filter;

interface FilterContract
{
    public function __invoke($query, $keyword): void;
}
