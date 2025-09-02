<?php

declare(strict_types=1);

namespace App\Services\Permissions;

use App\Services\Permissions\Models\SharedPermissions;
use App\Services\Permissions\Services\CrmPermissions;
use App\Services\Permissions\Services\ShopPermissions;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PermissionsService
{
    public static function showPermissionsByService(array $services): Collection
    {
        $permissions = [];

        if (in_array('shop', $services, true)) {
            $permissions = array_merge($permissions, ShopPermissions::all());
        }

        if (in_array('crm', $services, true)) {
            $permissions = array_merge($permissions, CrmPermissions::all());
        }

        $permissions[] = resolve(SharedPermissions::class)->all();

        return collect($permissions)
            ->unique('group');
    }

    public static function generatePermissionsByModel(string $model, ...$permissions): array
    {
        $res    = ['Admin'];
        $model = str_replace('\\', '/', $model);
        $prefix = basename($model);
        $res[]  = $prefix . '.' . 'All';
        foreach ($permissions as $permission) {
            $res[] = $prefix . '.' . Str::studly($permission);
        }

        return array_unique($res);
    }
}
