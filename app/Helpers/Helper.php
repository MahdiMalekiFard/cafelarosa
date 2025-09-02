<?php

declare(strict_types=1);

use App\ExtraAttributes\ProfileExtraEnum;
use App\Models\Setting;
use Illuminate\Support\Str;

if (!function_exists('rtlEnable')) {
    function rtlEnable(): bool
    {
        return config('app.locale') === 'fa';
    }
}

if (!function_exists('str_slug_persian')) {
    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param string $title
     * @param string $separator
     *
     * @return string
     */
    function str_slug_persian($title, $separator = '-')
    {
        $title = trim($title);
        $title = mb_strtolower($title, 'UTF-8');
        
        $title = str_replace('‌', $separator, $title);
        
        $title = preg_replace(
            '/[^a-z0-9_\s\-اآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوةيإأۀءهی۰۱۲۳۴۵۶۷۸۹٠١٢٣٤٥٦٧٨٩]/u',
            '',
            $title
        );
        
        $title = preg_replace('/[\s\-_]+/', ' ', $title);
        $title = preg_replace('/[\s_]/', $separator, $title);
        $title = trim($title, $separator);
        
        return $title;
    }
}
if (!function_exists('get_tag')) {
    function get_tag($collection, $key)
    {
        return $collection->where('key', $key)->first()->value ?? '';
    }
}

if (!function_exists('enNum')) {
    function enNum($string)
    {
        static $fromchar = [
            '۰',
            '۱',
            '۲',
            '۳',
            '۴',
            '۵',
            '۶',
            '۷',
            '۸',
            '۹',
            '٠',
            '١',
            '٢',
            '٣',
            '٤',
            '٥',
            '٦',
            '٧',
            '٨',
            '٩',
        ];
        static $num = [
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
        ];
        
        return str_replace($fromchar, $num, $string);
    }
}

if (!function_exists('loadImage')) {
    function loadMedia($model, $collection, $with, $height = null)
    {
        $height ??= $with;
        
        return !empty($model->getFirstMediaUrl($collection, $with))
            ? $model->getFirstMediaUrl($collection, $with)
            : loadPlaceHolder($with === 'thumb' ? 200 : $with, $height === 'thumb' ? 200 : $height);
    }
}

if (!function_exists('loadTest')) {
    function loadTestImage($with, $height = null)
    {
        return '/assets/media/misc/image.png';
        $height ??= $with;
        
        return 'https://unsplash.it/' . $with . '/' . $height . '/?random';
    }
}
if (!function_exists('loadPlaceHolder')) {
    function loadPlaceHolder($with, $height = null, $textColor = null, $backgroundColor = null, $text = null)
    {
        return '/assets/media/misc/image.png';
        
        $height ??= $with;
        $text = $text ? '?text=' . $text : '';
        $textColor = $textColor ? '/' . $textColor : '/54b948';
        $backgroundColor = $backgroundColor ? '/' . $backgroundColor : '/6c757d';
        return 'https://via.placeholder.com/' . $with . 'x' . $height . $backgroundColor . $textColor . $text;
    }
}

if (!function_exists('loadAvatar')) {
    function loadAvatar($model, $collection, $with, $height = null)
    {
        return !empty($model->getFirstMediaUrl($collection, $with))
            ? $model->getFirstMediaUrl($collection, $with)
            : 'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60';
    }
}

if (!function_exists('menuActive')) {
    function menuActive(array $urls, bool $exact = false): bool
    {
        if (!$exact) {
            foreach ($urls as $url) {
                if (Str::contains($url, '/admin')) {
                    $urls[] = str_replace('/admin', 'admin', $url);
                }
                if (Str::contains($url, '/*')) {
                    $urls[] = str_replace('/*', '', $url);
                }
                $url .= '/*';
                $urls[] = $url;
            }
        }
        
        $urls = collect($urls)->map(function ($url) {
            return str_replace(config('app.url'), '', $url);
        })->toArray();
        $fullUrls = collect($urls)->map(function ($url) {
            return config('app.url') . $url;
        })->toArray();
        $urls = array_merge($urls, $fullUrls);
        
        return request()->is($urls) || request()->fullUrlIs($urls);
    }
}
if (!function_exists('parentMenuActive')) {
    function parentMenuActive(array $urls): bool
    {
        foreach ($urls as $url) {
            if (Str::contains($url, '/admin')) {
                $urls[] = str_replace('/admin', 'admin', $url);
            }
            $url .= '/*';
            $urls[] = $url;
        }
        
        $urls = collect($urls)->map(function ($url) {
            return str_replace(config('app.url'), '', $url);
        })->toArray();
        $fullUrls = collect($urls)->map(function ($url) {
            return config('app.url') . $url;
        })->toArray();
        $urls = array_merge($urls, $fullUrls);
        
        return request()->is($urls) || request()->fullUrlIs($urls);
    }
}
if (!function_exists('loadSvg')) {
    function loadSvg($url, $class = '')
    {
        $svg = '<span class="svg-icon ' . $class . '">' . file_get_contents($url) . '</span>';
        echo $svg;
    }
}
if (!function_exists('convert_bytes_to_specified')) {
    function convert_bytes_to_specified($bytes, $to, $decimal_places = 1)
    {
        $formulas = [
            'K' => number_format($bytes / 1024, $decimal_places),
            'M' => number_format($bytes / 1048576, $decimal_places),
            'G' => number_format($bytes / 1073741824, $decimal_places),
        ];
        
        return isset($formulas[$to]) ? $formulas[$to] : 0;
    }
}

if (!function_exists('checkNotify')) {
    function checkNotify($user, $key, $value = 'on')
    {
        if (isset($user->extra_attributes->notify)) {
            if (array_key_exists($key, $user->extra_attributes->notify)) {
                return (bool)($user->extra_attributes->notify[$key] == $value);
            }
        }
        $default = $key . '_default';
        
        return trans('other.user_extra_attributes.notify.' . $default) == 'on' ? true : false;
    }
}

// if ( ! function_exists('getSetting')) {
//    /**
//     * @throws JsonException
//     */
//    function getSetting($key, $extra = null): string
//    {
//        $cache_unique_key = 'setting:' . $key;
//        if (cache()->has($key)) {
//            $setting = new Setting;
//            $setting->fill(json_decode(cache($cache_unique_key), true, 512, JSON_THROW_ON_ERROR));
//            if ($extra !== null) {
//                return $setting->extra_attributes->get($extra) ?? '';
//            }
//
//            return $setting->value ?? 'no_param';
//        }
//        $setting = Setting::where('key', $key)->first();
//        if ($setting) {
//            cache()->forever($cache_unique_key, $setting);
//            if ($extra === null) {
//                return $setting->value ?? 'no_param';
//            }
//
//            return $setting->extra_attributes->get($extra) ?? '';
//        }
//
//        return '';
//    }
// }
if (!function_exists('checkCanonical')) {
    function checkCanonical($url = null, $canonical = null)
    {
        if (!empty($canonical)) {
            return $canonical;
        }
        
        return $url;
    }
}

if (!function_exists('change_key')) {
    function change_key($array, $old_key, $new_key)
    {
        if (!array_key_exists($old_key, $array)) {
            return $array;
        }
        
        $keys = array_keys($array);
        $keys[array_search($old_key, $keys)] = $new_key;
        
        return array_combine($keys, $array);
    }
}
if (!function_exists('change_keys')) {
    function change_keys($array, $keys)
    {
        $data = json_encode($array);
        foreach ($keys as $needed => $replace) {
            $data = str_replace('"' . $needed . '":', '"' . $replace . '":', $data);
        }
        
        return json_decode($data, true);
    }
}
if (!function_exists('is_rtl')) {
    function is_rtl($string): bool
    {
        $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
        
        return (bool)preg_match($rtl_chars_pattern, $string);
    }
}
if (!function_exists('mb_sprintf')) {
    function mb_sprintf(string $format, ...$args): string
    {
        $params = $args;
        /** @var Closure $callback */
        $callback = function ($length) use (&$params) {
            $value = array_shift($params);
            
            return $length[0] + strlen($value) - mb_strwidth($value);
        };
        $format = preg_replace_callback('/(?<=%|%-)\d+(?=s)/', $callback, $format);
        
        return sprintf($format, ...$args);
    }
}

if (!function_exists('_dd')) {
    function _dd(...$args)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        call_user_func_array('dd', $args);
    }
}

if (!function_exists('_dds')) {
    /**
     * @throws JsonException
     */
    function _dds($args): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');
        header('Content-Type: application/json');
        exit(json_encode($args, JSON_THROW_ON_ERROR));
    }
}

if (!function_exists('isRtl')) {
    function isRtl(...$args): bool
    {
        return in_array(auth()->user()?->profile->extra_attributes->get(ProfileExtraEnum::LANGUAGE->value, config('app.locale')), ['fa', 'ar'], true);
        //        return in_array(app()->getLocale(), ['fa', 'ar'], true);
    }
}

if (!function_exists('generateCacheKey')) {
    function generateCacheKey(string $type, int $id, string $key, string $local): string
    {
        $type = str_replace('\\', '/', $type);
        return 'translated:' . class_basename($type) . ':' . $id . ':' . $key . ':' . $local;
    }
}

function static_content($key, $locale = null)
{
    $locale = $locale ?? app()->getLocale();
    return app('static_content')->get($key, $locale) ?? '';
}

function static_content_object($key, $locale = null)
{
    $locale = $locale ?? app()->getLocale();
    return app('static_content')->getObject($key, $locale);
}