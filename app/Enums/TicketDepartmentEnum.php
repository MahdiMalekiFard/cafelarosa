<?php

declare(strict_types=1);

namespace App\Enums;

enum TicketDepartmentEnum: string
{
    use EnumToArray;
    case CONTACT = 'contact';
    case SELL    = 'sell';
    case RENT    = 'rent';

    public function title(): string
    {
        return match ($this) {
            self::CONTACT => __('ticket.contact'),
            self::SELL    => __('ticket.sell'),
            self::RENT    => __('ticket.rent'),
        };
    }
}
