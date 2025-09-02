<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ActivationCode;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class ActivationCodePolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(ActivationCode::class, 'Index'));
    }

    public function view(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(ActivationCode::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(ActivationCode::class, 'Store'));
    }

    public function update(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(ActivationCode::class, 'Update'));
    }

    public function delete(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(ActivationCode::class, 'Delete'));
    }

    public function restore(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(ActivationCode::class, 'Restore'));
    }

    public function forceDelete(User $user, ActivationCode $activationCode): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(ActivationCode::class));
    }
}
