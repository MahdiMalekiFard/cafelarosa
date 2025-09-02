<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Traits\HasCategories;
use App\Traits\HasComment;
use App\Traits\HasLike;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use App\Traits\HasUUID;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

/**
 * @property string $title
 * @property string $description
 * @property string $body
 */
class Blog extends Model implements HasMedia
{
    use HasCategories,
        HasComment,
        HasFactory,
        HasLike,
        HasSchemalessAttributes,
        HasSlugFromTranslationTitle,
        HasTags,
        HasTranslationAuto,
        HasUser,
        HasUUID,
        HasView,
        InteractsWithMedia,
        SoftDeletes;

    public array $translatable = [
        'title',
        'description',
        'body',
    ];

    protected $fillable = [
        'uuid', 'slug', 'user_id', 'published', 'total_view', 'total_comment', 'total_like', 'languages',
        'extra_attributes', 'seo_title', 'seo_description', 'seo_keywords',
    ];

    protected $casts = [
        'total_comment' => 'integer',
        'total_view'    => 'integer',
        'total_like'    => 'integer',
        'languages'     => 'array',
        'published'     => BooleanEnum::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->registerMediaConversions(
                function () {
                    $this->addMediaConversion('thumb')->fit(Fit::Crop, 100, 100);
                    $this->addMediaConversion('480')->fit(Fit::Crop, 854, 480);
                    $this->addMediaConversion('720')->fit(Fit::Crop, 1280, 720);
                }
            );
    }

    public function scopeActive(Builder $query, bool $value=true): Builder
    {
        return $query->where('published', $value);
    }

    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => route('blog.detail', ['locale' => app()->getLocale(), 'blog' => $attributes['slug']])
        );
    }
}
