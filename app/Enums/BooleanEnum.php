<?php

declare(strict_types=1);

namespace App\Enums;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="BooleanSchema",
 *     title="BooleanSchema",
 *     description="Boolean enum",
 *     type="object",
 *
 *     @OA\Xml(name="BooleanSchema"),
 *
 *     @OA\Property(property="value", type="boolean", description="Boolean value", example="true"),
 *     @OA\Property(property="label", type="string", description="Boolean label", example="Enable"),
 * )
 */
enum BooleanEnum: int
{
    case DISABLE = 0;
    case ENABLE  = 1;

    public function title(): string
    {
        return match ($this) {
            self::DISABLE => __('core.disable'),
            self::ENABLE  => __('core.enable'),
        };
    }

    public function toArray(): array
    {
        return [
            'value' => (bool) $this->value,
            'label' => $this->title(),
        ];
    }
}
