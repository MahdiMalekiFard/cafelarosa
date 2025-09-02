<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 */
class Area extends Model
{
    use HasFactory;

    public array $translatable = [
        'title',
    ];

    protected $fillable = [
        'city_id',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class);
    }
}
