<?php

declare(strict_types=1);

namespace App\Enums;

enum ArtGalleryTypeEnum: string
{
    use EnumToArray;

    case All = 'all';

    public function title(): string
    {
        return match ($this) {
            self::All      => trans('artGallery.enum.type.all'),
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
