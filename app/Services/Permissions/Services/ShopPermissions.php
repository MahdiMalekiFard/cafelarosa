<?php

declare(strict_types=1);

namespace App\Services\Permissions\Services;

use App\Services\Permissions\Models\BlogPermissions;
use App\Services\Permissions\Models\UserPermissions;

class ShopPermissions
{
    public static function all(): array
    {
        return [
            resolve(BlogPermissions::class)->all(),
            resolve(UserPermissions::class)->all(),
            // Add more entity permissions as needed
        ];
    }
}
