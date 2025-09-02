<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Locality;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class LocalityPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Locality::class, 'Index'));
    }

    public function view(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Locality::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Locality::class, 'Store'));
    }

    public function update(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Locality::class, 'Update'));
    }

    public function delete(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Locality::class, 'Delete'));
    }

    public function restore(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Locality::class, 'Restore'));
    }

    public function forceDelete(User $user, Locality $locality): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Locality::class));
    }
}
