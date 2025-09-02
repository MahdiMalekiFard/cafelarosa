<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BooleanEnum;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

/**
 * @property string $title
 */
class Menu extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslationAuto;
    use InteractsWithMedia;
    use SchemalessAttributesTrait;

    protected $fillable = [
        'published', 'languages'
    ];

    protected $casts = [
        'published'        => BooleanEnum::class,
        'languages'        => 'array',
        'extra_attributes' => 'array'
    ];

    public array $translatable = [
        'title', 'description'
    ];

    /*
    |--------------------------------------------------------------------------
    | Model Configuration
    |--------------------------------------------------------------------------
    */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
             ->registerMediaConversions(
                 function () {
                     $this->addMediaConversion('thumb')->fit(Fit::Crop, 100, 100);
                     $this->addMediaConversion('480')->fit(Fit::Crop, 854, 480);
                     $this->addMediaConversion('720')->fit(Fit::Crop, 1280, 720);
                 }
             );

        $this->addMediaCollection('left_image')
             ->registerMediaConversions(
                 function () {
                     $this->addMediaConversion('thumb')->fit(Fit::Crop, 100, 100);
                     $this->addMediaConversion('480')->fit(Fit::Crop, 854, 480);
                     $this->addMediaConversion('720')->fit(Fit::Crop, 1280, 720);
                 }
             );

        $this->addMediaCollection('right_image')
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
    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }

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
