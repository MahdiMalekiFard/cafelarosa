<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Province;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class ProvincePolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Province::class, 'Index'));
    }

    public function view(User $user, Province $province): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Province::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Province::class, 'Store'));
    }

    public function update(User $user, Province $province): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Province::class, 'Update'));
    }

    public function delete(User $user, Province $province): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Province::class, 'Delete'));
    }

    public function restore(User $user, Province $province): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Province::class, 'Restore'));
    }

    public function forceDelete(User $user, Province $province): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Province::class));
    }
}
