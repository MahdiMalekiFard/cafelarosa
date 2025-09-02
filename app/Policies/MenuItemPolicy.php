<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\MenuItem;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class MenuItemPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(MenuItem::class, 'Index'));
    }

    public function view(User $user, MenuItem $menuItem): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(MenuItem::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(MenuItem::class, 'Store'));
    }

    public function update(User $user, MenuItem $menuItem): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(MenuItem::class, 'Update'));
    }

    public function delete(User $user, MenuItem $menuItem): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(MenuItem::class, 'Delete'));
    }

    public function restore(User $user, MenuItem $menuItem): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(MenuItem::class, 'Restore'));
    }

    public function forceDelete(User $user, MenuItem $menuItem): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(MenuItem::class));
    }
}
