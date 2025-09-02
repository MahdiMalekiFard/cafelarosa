<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Closure;
use Illuminate\Support\Str;

trait FillAttributes
{
    public function attributes(): array
    {
        return $this->generateAttributes();
    }
    
    public function generateAttributes(): array
    {
        return collect($this->rules())->filter(function ($item, $key) {
            return Str::contains($key, '.');
        })->map(function ($item, $key) {
            $key = 'validation.attributes.' . last(explode('.', $key));

            return trans($key);
        })->toArray();
    }
    
    /**
     * you can pass for every piece of translation rules as array or string or closer
     * NOTE : translation field for current locale is required by default to disabling that just pass nullable
     */
    public function generateTranslation(
        string|array|Closure $titleRules = [],
        string|array|Closure $bodyRules = [],
        string|array|Closure $summeryRules = [],
    ): array {
        $appLocale = app()->getLocale();
        
        [$titleRules, $bodyRules, $summeryRules] = collect(
            [$titleRules, $bodyRules, $summeryRules]
        )->map(function ($item) {
            if (is_string($item)) {
                return explode('|', $item);
            } elseif ($item instanceof Closure) {
                return [$item];
            }
            
            return $item;
        });
        
        return [
            'translation'                    => 'required|array',
            "translation.{$appLocale}.title" => [
                ! in_array('nullable', $titleRules) ? 'required' : null,
                ...$titleRules,
            ],
            'translation.*.title'            => $titleRules,
            'translation.*.body'             => $bodyRules,
            'translation.*.summery'          => $summeryRules,
        ];
    }
}
