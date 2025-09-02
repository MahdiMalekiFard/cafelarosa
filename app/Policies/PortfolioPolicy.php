<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class PortfolioPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Portfolio::class, 'Index'));
    }

    public function view(User $user, Portfolio $portfolio): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Portfolio::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Portfolio::class, 'Store'));
    }

    public function update(User $user, Portfolio $portfolio): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Portfolio::class, 'Update'));
    }

    public function delete(User $user, Portfolio $portfolio): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Portfolio::class, 'Delete'));
    }

    public function restore(User $user, Portfolio $portfolio): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Portfolio::class, 'Restore'));
    }

    public function forceDelete(User $user, Portfolio $portfolio): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Portfolio::class));
    }
}
