<?php

declare(strict_types=1);

namespace App\Helpers;

class StringHelper
{
    public static function convertToClassName($input): string
    {
        $names = explode('_', $input);
        if (count($names) == 1) {
            $names = explode('-', $input);
        }
        foreach ($names as $index => $name) {
            $names[$index] = ucwords(strtolower($name));
        }

        return implode('', $names);
    }

    public static function enNum($string): array|string
    {
        static $fromChar = [
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

        return str_replace($fromChar, $num, $string);
    }

    public static function calcDuration($seconds): string
    {
        $secs = $seconds % 60;
        $hrs  = $seconds / 60;
        $mins = $hrs % 60;

        $hrs = $hrs / 60;

        return (int) $hrs . ':' . (int) $mins . ':' . (int) $secs;
    }

    public static function slug($title, $separator = '-'): string
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
