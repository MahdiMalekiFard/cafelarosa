<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PageTypeEnum;
use App\Helpers\Constants;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

/**
 * @property string $title
 */
class Page extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslationAuto;
    use SchemalessAttributesTrait;
    use InteractsWithMedia;

    protected $fillable = [
        'type', 'languages',
    ];

    protected function casts(): array
    {
        return [
            'type'             => PageTypeEnum::class,
            'languages'        => 'array',
            'extra_attributes' => 'array',
        ];
    }

    public array $translatable = [
        'title', 'body'
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
             ->useFallbackUrl('/img/about/about.jpg')
             ->registerMediaConversions(
                 function () {
                     $this->addMediaConversion('400x633')
                          ->fit(Fit::Crop, 400, 633);
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
