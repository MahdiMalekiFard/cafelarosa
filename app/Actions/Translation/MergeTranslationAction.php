<?php

declare(strict_types=1);

namespace App\Actions\Translation;

use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class MergeTranslationAction
{
    use AsAction;

    public function handle($model, array $payload): void
    {
        $locale = Arr::get($payload, 'locale', app()->getLocale());

        request()->merge([
            'translation' => [
                $locale => [
                    [
                        'key'   => 'title',
                        'value' => $payload['title'],
                    ],
                    [
                        'key'   => 'description',
                        'value' => $payload['description'],
                    ],
                    [
                        'key'   => 'body',
                        'value' => $payload['body'],
                    ],
                ],
            ],
        ]);
    }
}
