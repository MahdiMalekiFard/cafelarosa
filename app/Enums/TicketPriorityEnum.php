<?php

declare(strict_types=1);

namespace App\Enums;

enum TicketPriorityEnum: string
{
    use EnumToArray;

    case LOW    = 'low';
    case NORMAL = 'normal';
    case HIGH   = 'high';

    public function title(): string
    {
        return match ($this) {
            self::LOW    => __('ticket.low'),
            self::NORMAL => __('ticket.normal'),
            self::HIGH   => __('ticket.high'),
        };
    }
}
