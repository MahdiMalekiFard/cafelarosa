<?php

declare(strict_types=1);

namespace App\Traits;

use App\Helpers\StringHelper;
use Closure;

/**
 * @method static creating(Closure $param)
 */
trait HasSlugFromTranslationTitle
{
    protected static function bootHasSlugFromTranslationTitle(): void
    {
        /** @phpstan-ignore-next-line */
        self::creating(function ($model) {
            if (empty($model->slug)) {
                if ( ! empty(request()->input('title', null))) {
                    $model->slug = StringHelper::slug(request()->input('title', null));
                } else {
                    $locale           = app()->getLocale();
                    $localTranslation = request()->input('translation', [$locale => []])[$locale];
                    $title            = collect($localTranslation)->where('key', 'title')->first()['value'] ?? null;
                    if (is_null($title)) {
                        abort(400, get_class($model) . ' : translation ' . $locale . ' can not null');
                    }
                    $originalSlug = $proposedSlug = StringHelper::slug($title);
                    $counter      = 1;
                    while ($model::where('slug', $proposedSlug)->exists()) {
                        $proposedSlug = $originalSlug . '-' . $counter;
                        $counter++;
                    }
                    $model->slug = $proposedSlug;
                }
            }
        });
    }
}
