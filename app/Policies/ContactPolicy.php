<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use App\Services\Permissions\PermissionsService;

class ContactPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Contact::class, 'Index'));
    }

    public function view(User $user, Contact $contact): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Contact::class, 'Show'));
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Contact::class, 'Store'));
    }

    public function update(User $user, Contact $contact): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Contact::class, 'Update'));
    }

    public function delete(User $user, Contact $contact): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Contact::class, 'Delete'));
    }

    public function restore(User $user, Contact $contact): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Contact::class, 'Restore'));
    }

    public function forceDelete(User $user, Contact $contact): bool
    {
        return $user->hasAnyPermission(PermissionsService::generatePermissionsByModel(Contact::class));
    }
}
