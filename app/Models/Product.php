<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Traits\HasSchemalessAttributes;
use App\Traits\HasSlugFromTranslationTitle;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\SchemalessAttributes;

/**
 * @property string $title
 */
class Product extends Model implements HasMedia
{
    use HasFactory,
        HasTranslationAuto,
        HasSchemalessAttributes,
        HasSlugFromTranslationTitle,
        InteractsWithMedia,
        SoftDeletes,
        HasUUID;
    
    protected $fillable = [
        'published', 'uuid', 'slug', 'languages', 'extra_attributes',
    ];
    
    protected $casts = [
        'published'        => BooleanEnum::class,
        'languages'        => 'array',
        'extra_attributes' => 'array',
        'deleted_at'       => 'datetime',
    ];
    
    public array $translatable = [
        'title', 'body',
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
    public function extra(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'extra_attributes');
    }
    
}
