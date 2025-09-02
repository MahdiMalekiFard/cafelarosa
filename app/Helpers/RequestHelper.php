<?php

declare(strict_types=1);

namespace App\Helpers;

class RequestHelper
{
    public static function mergeArray($key, $value, $arrayName = 'filter')
    {
        $previousValue = request()->input($arrayName, []);
        $newValue      =
            [
                $key => $value,
            ];
        $mergedValue = collect($previousValue)->merge($newValue)->toArray();
        request()->merge([$arrayName => $mergedValue]);
    }

    public static function clearRequest()
    {
        foreach (request()->keys() as $key) {
            request()->offsetUnset($key);
        }
    }
}
