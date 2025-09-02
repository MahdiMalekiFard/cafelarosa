<?php

declare(strict_types=1);

namespace App\Enums;

enum TicketStatusEnum: string
{
    use EnumToArray;

    case OPEN  = 'open';
    case CLOSE = 'close';

    public function title(): string
    {
        return match ($this) {
            self::OPEN  => __('ticket.open'),
            self::CLOSE => __('ticket.close'),
        };
    }
}
