<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Traits\HasCategories;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Spatie\Tags\HasTags;

/**
 * @property string $title
 */
class Portfolio extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslationAuto;
    use InteractsWithMedia;
    use SoftDeletes;
    use HasSlugFromTranslationTitle;
    use SchemalessAttributesTrait;
    use HasCategories;
    use HasView;
    use HasTags;

    protected $fillable = [
        'published', 'slug', 'seo_title', 'seo_description', 'languages', 'total_view',
    ];

    protected $casts = [
        'published'        => BooleanEnum::class,
        'languages'        => 'array',
        'extra_attributes' => 'array',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'deleted_at'       => 'datetime',
    ];

    public array $translatable = [
        'title', 'description', 'body'
    ];

    /*
    |--------------------------------------------------------------------------
    | Model Configuration
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | Model Relations
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Model Scope
    |--------------------------------------------------------------------------
    */
    public function scopeActive(Builder $query, bool $value = true): Builder
    {
        return $query->where('published', $value);
    }

    /*
    |--------------------------------------------------------------------------
    | Model Attributes
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Model Custom Methods
    |--------------------------------------------------------------------------
    */

}
