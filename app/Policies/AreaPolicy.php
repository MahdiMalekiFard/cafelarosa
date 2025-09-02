<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Area;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class AreaPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Area::class, 'Index'));
    }

    public function view(User $user, Area $area): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Area::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Area::class, 'Store'));
    }

    public function update(User $user, Area $area): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Area::class, 'Update'));
    }

    public function delete(User $user, Area $area): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Area::class, 'Delete'));
    }

    public function restore(User $user, Area $area): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Area::class, 'Restore'));
    }

    public function forceDelete(User $user, Area $area): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Area::class));
    }
}
