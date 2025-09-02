<?php

declare(strict_types=1);

namespace App\ExtraAttributes;

enum ProfileExtraEnum: string
{
    case THEME     = 'theme';
    case LANGUAGE  = 'language';
    case CONTAINER = 'container';

    public function title(): string
    {
        return match ($this) {
            self::THEME     => 'Theme',
            self::LANGUAGE  => 'Language',
            self::CONTAINER => 'Container',
        };
    }
}
