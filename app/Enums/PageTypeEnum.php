<?php

declare(strict_types=1);

namespace App\Enums;

enum PageTypeEnum: string
{
    use EnumToArray;

    case ABOUT_US = 'about-us';

    public function title(): string
    {
        return match ($this) {
            self::ABOUT_US => trans('page.enum.type.about_us'),
        };
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => $this->title(),
        ];
    }
}
