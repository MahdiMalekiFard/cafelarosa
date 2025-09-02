<?php

declare(strict_types=1);

namespace App\Enums;

enum CategoryTypeEnum: string
{
    use EnumToArray;

    case BLOG = 'blog';
    case FAQ = 'faq';
    case PORTFOLIO = 'portfolio';
    case MENU = 'menu';

    public function title(): string
    {
        return match ($this) {
            self::BLOG      => trans('category.enum.type.blog'),
            self::FAQ       => trans('category.enum.type.faq'),
            self::PORTFOLIO => trans('category.enum.type.portfolio'),
            self::MENU      => trans('category.enum.type.menu'),
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
