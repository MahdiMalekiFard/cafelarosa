<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Country;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class CountryPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Country::class, 'Index'));
    }

    public function view(User $user, Country $country): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Country::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Country::class, 'Store'));
    }

    public function update(User $user, Country $country): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Country::class, 'Update'));
    }

    public function delete(User $user, Country $country): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Country::class, 'Delete'));
    }

    public function restore(User $user, Country $country): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Country::class, 'Restore'));
    }

    public function forceDelete(User $user, Country $country): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Country::class));
    }
}
