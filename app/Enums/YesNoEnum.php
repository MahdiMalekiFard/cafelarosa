<?php

declare(strict_types=1);

namespace App\Enums;

enum YesNoEnum: int
{
    case YES  = 1;
    case NO   = 0;

    public function title()
    {
        return match ($this) {
            self::YES => 'بله',
            self::NO  => 'خیر'
        };
    }
}
