<?php

declare(strict_types=1);

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function format($date, $format = Constants::DEFAULT_DATE_FORMAT): string
    {
        switch (app()->getLocale()) {
            case 'fa':
                return jdate($date)->format($format);
            default:
                return Carbon::parse($date)->format($format);
        }
    }
}
