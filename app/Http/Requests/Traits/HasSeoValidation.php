<?php

declare(strict_types=1);

namespace App\Http\Requests\Traits;

use App\Enums\SeoRobotsMetaEnum;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

trait HasSeoValidation
{
    /**
     * Get SEO validation rules.
     */
    public function getSeoRules(): array
    {
        return [
            'seo_title'       => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'canonical'       => ['nullable', 'string', 'max:255', 'url'],
            'old_url'         => ['nullable', 'string', 'max:255', 'url'],
            'redirect_to'     => ['nullable', 'string', 'max:255', 'url'],
            'robots_meta'     => ['nullable', 'string', Rule::in(SeoRobotsMetaEnum::values())],
        ];
    }

    /**
     * Prepare SEO data for validation.
     * Override this method if you need custom logic for a specific request.
     */
    protected function prepareSeoForValidation(): void
    {
        $titleField = $this->input('title');
        $descriptionField = $this->input('description') ?? $this->input('body');
        $seoTitle = $this->input('seo_title');
        $seoDescription = $this->input('seo_description');
        
        $this->merge([
            'seo_title'       => $seoTitle ?? $titleField,
            'seo_description' => $seoDescription ?? ($descriptionField ? Str::limit($descriptionField, 188) : null),
        ]);
    }
}

