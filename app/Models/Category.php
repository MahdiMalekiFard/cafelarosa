<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Enums\CategoryTypeEnum;
use App\Traits\HasCategories;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $title
 * @property string $body
 */
class Category extends Model implements HasMedia
{
    use HasCategories,
        HasFactory,
        HasSlugFromTranslationTitle,
        HasTranslationAuto,
        HasUUID, InteractsWithMedia;

    public array $translatable = ['title', 'description', 'body'];

    protected $fillable = [
        'published', 'parent_id', 'slug', 'type', 'seo_title', 'seo_description', 'seo_keywords', 'languages',
    ];

    protected $casts = [
        'type'      => CategoryTypeEnum::class,
        'published' => BooleanEnum::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->registerMediaConversions(
                function () {
                    $this->addMediaConversion('thumb')->width(200)->height(200);
                    $this->addMediaConversion('480')->width(854)->height(480);
                }
            );
    }

    public function scopeWithRelations(Builder $query, ...$relations): Builder
    {
        return $query->with($relations);
    }

    public function scopeActive(Builder $query, bool $value = true): Builder
    {
        return $query->where('published', $value);
    }

    public function categoryable(): MorphTo
    {
        return $this->morphTo();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function blogs(): MorphToMany
    {
        return $this->morphedByMany(Blog::class, 'categoryable');
    }
}
