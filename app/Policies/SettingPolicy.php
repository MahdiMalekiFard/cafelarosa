<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class SettingPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Setting::class, 'Index'));
    }

    public function view(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Setting::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Setting::class, 'Store'));
    }

    public function update(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Setting::class, 'Update'));
    }

    public function delete(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Setting::class, 'Delete'));
    }

    public function restore(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Setting::class, 'Restore'));
    }

    public function forceDelete(User $user, Setting $setting): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Setting::class));
    }
}
