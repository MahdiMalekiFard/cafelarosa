<?php

namespace App\Models;

use App\Enums\SeoRobotsMetaEnum;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MorphAttributesTrait;

class SeoOption extends Model
{
    use MorphAttributesTrait;

    protected $table = 'seo_options';

    protected $fillable = [
        'morphable_type', 'morphable_id', 'title', 'description', 'canonical', 'old_url', 'redirect_to', 'robots_meta',
    ];

    protected $casts = [
        'robots_meta' => SeoRobotsMetaEnum::class,
    ];
}
