<?php

declare(strict_types=1);

namespace App\Actions\Translation;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class GetTranslationAction
{
    use AsAction;

    /**
     * @throws Throwable
     */
    public function handle($model, array $payload = []): void
    {
        DB::transaction(function () use ($model, $payload) {
            $translationRelation = $model->translations();
            foreach (request()->input('translation', $payload) as $locale => $values) {
                foreach ($values as $item) {
                    $translationRelation->create([
                        'key'    => $item['key'],
                        'value'  => $item['value'],
                        'locale' => $locale,
                    ]);
                }
            }
        });
    }
}
