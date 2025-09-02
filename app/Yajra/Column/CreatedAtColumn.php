<?php

declare(strict_types=1);

namespace App\Yajra\Column;

use App\Helpers\Constants;

class CreatedAtColumn implements ColumnContract
{
    public function __invoke($row): string
    {
        return jdate($row->updated_at)->format(
            Constants::DEFAULT_DATE_FORMAT
        );
    }
}
