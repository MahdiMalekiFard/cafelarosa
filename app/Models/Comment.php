<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BooleanEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uuid',
        'parent_id',
        'commentable_id',
        'commentable_type',
        'published',
        'comment',
    ];

    protected $casts = [
        'published' => BooleanEnum::class,
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function child(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function getParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function scopeActive(Builder $query, bool $value = true): Builder
    {
        return $query->where('published', $value);
    }
}
