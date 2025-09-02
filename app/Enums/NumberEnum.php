<?php

declare(strict_types=1);

namespace App\Enums;

enum NumberEnum: int
{
    case NUM_0 = 0;
    case NUM_1 = 1;
    case NUM_2 = 2;
    case NUM_3 = 3;
    case NUM_4 = 4;
    case NUM_5 = 5;

    public function title(): string
    {
        return match ($this) {
            self::NUM_0 => __('core.number.num_0'),
            self::NUM_1 => __('core.number.num_1'),
            self::NUM_2 => __('core.number.num_2'),
            self::NUM_3 => __('core.number.num_3'),
            self::NUM_4 => __('core.number.num_4'),
            self::NUM_5 => __('core.number.num_5'),
        };
    }
}
