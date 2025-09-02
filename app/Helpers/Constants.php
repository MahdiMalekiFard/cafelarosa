<?php

declare(strict_types=1);

namespace App\Helpers;

class Constants
{
    const CACHE_TIME_30                 = 108000; // 30 min
    const CACHE_TIME_60                 = 216000; // 60 min
    const CACHE_TIME_1_DAY              = 5184000; // 60*24 min
    const DEFAULT_DATE_FORMAT           = 'Y/m/d';
    const DEFAULT_DATE_FORMAT_WITH_TIME = 'H:i , Y/m/d';
    const DEFAULT_PAGINATE              = 10;
    const DEFAULT_PAGINATE_WEB          = 21;

    public const RESOLUTION_480        = '854 * 480';
    public const RESOLUTION_480_SQUARE = '480 * 480';
    public const RESOLUTION_720        = '1280 * 720';
    public const RESOLUTION_720_SQUARE = '720 * 720';

    public const RESOLUTION_1080        = '1920 * 1080';

    public const RESOLUTION_512_SQUARE = '512 * 512';
}
