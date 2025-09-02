<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 */
class Province extends Model
{
    use HasFactory,
        HasTranslationAuto,
        HasUUID;

    public array $translatable = [
        'title',
    ];

    protected $fillable = [
        'uuid', 'country_id', 'published',
    ];

    protected $casts = [
        'published' => BooleanEnum::class,
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeActive(Builder $query, bool $value = true): Builder
    {
        return $query->where('published', $value);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'province_id');
    }
}
