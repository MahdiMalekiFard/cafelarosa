<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class Utils
{
    public static function getEloquent(string $type): ?string
    {
        $reference = Str::studly($type);
        $model     = 'App\\Models\\' . $reference;
        return match ($type) {
            'user'  => User::class,
            default => $model,
        };
    }

    public static function getResource($eloquentClass): string
    {
        return 'App\\Http\\Resources\\' . class_basename($eloquentClass) . 'Resource';
    }

    public static function getService($eloquentClass)
    {
        return app('App\\Services\\' . class_basename($eloquentClass) . '\\' . class_basename($eloquentClass) . 'Service');
    }

    public static function getRepository($eloquentClass)
    {
        return app('App\\Repositories\\' . class_basename($eloquentClass) . '\\' . class_basename($eloquentClass) . 'RepositoryInterface');
    }

    public static function generateSlug($title, $separator = '-'): string
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

        return trim($title, $separator);
    }

    public static function getKeyFromEloquent($class): string
    {
        return Str::kebab(last(explode('\\', $class)));
    }

    public static function getMorphableResource(string $morphable_type): string
    {
        $model_name = Str::studly(last(explode('\\', $morphable_type)));

        return 'App\\Http\\Resources\\' . $model_name . 'Resource';
    }
}
