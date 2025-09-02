<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class MenuPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Menu::class, 'Index'));
    }

    public function view(User $user, Menu $menu): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Menu::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Menu::class, 'Store'));
    }

    public function update(User $user, Menu $menu): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Menu::class, 'Update'));
    }

    public function delete(User $user, Menu $menu): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Menu::class, 'Delete'));
    }

    public function restore(User $user, Menu $menu): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Menu::class, 'Restore'));
    }

    public function forceDelete(User $user, Menu $menu): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Menu::class));
    }
}
