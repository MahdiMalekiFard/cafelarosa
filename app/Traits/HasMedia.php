<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMedia
{
    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaable');
    }
}
