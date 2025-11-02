<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\SeoOption;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeoOption
{
    /**
     * Get the SEO option for the model.
     */
    public function seoOption(): MorphOne
    {
        return $this->morphOne(SeoOption::class, 'morphable');
    }
}

