<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasUUID
{
    public function scopeOfUuid(Builder $query, string $uuid): Builder
    {
        return $query->where('uuid', $uuid);
    }

    protected static function bootHasUUID(): void
    {
        /** @phpstan-ignore-next-line */
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
