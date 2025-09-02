<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class CityPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(City::class, 'Index'));
    }

    public function view(User $user, City $city): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(City::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(City::class, 'Store'));
    }

    public function update(User $user, City $city): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(City::class, 'Update'));
    }

    public function delete(User $user, City $city): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(City::class, 'Delete'));
    }

    public function restore(User $user, City $city): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(City::class, 'Restore'));
    }

    public function forceDelete(User $user, City $city): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(City::class));
    }
}
