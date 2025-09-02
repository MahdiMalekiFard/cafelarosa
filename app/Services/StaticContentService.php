<?php

namespace App\Services;

use App\Models\StaticContent;
use Illuminate\Support\Facades\Cache;

class StaticContentService
{
    public function get($key, $locale)
    {
        return Cache::rememberForever("static_content_{$key}_{$locale}", function () use ($key, $locale) {
            return StaticContent::where('key', $key)->where('locale', $locale)->pluck('value')->first();
        });
    }
    
    public function getObject($key, $locale)
    {
        return Cache::rememberForever("static_content_object_{$key}_{$locale}", function () use ($key, $locale) {
            return StaticContent::where('key', $key)->where('locale', $locale)->first();
        });
    }
}