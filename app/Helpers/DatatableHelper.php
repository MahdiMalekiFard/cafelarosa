<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\BooleanEnum;

class DatatableHelper
{
    public static function published(BooleanEnum $status): string
    {
        return $status->value ? __('datatable.publish') : __('datatable.un_publish');
    }
}
