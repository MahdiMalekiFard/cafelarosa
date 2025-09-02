<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Profile;

class ProfilePermissions extends BasePermissions
{
    public const All     = "Profile.All";
    public const Index   = "Profile.Index";
    public const Show    = "Profile.Show";
    public const Store   = "Profile.Store";
    public const Update  = "Profile.Update";
    public const Toggle  = "Profile.Toggle";
    public const Delete  = "Profile.Delete";
    public const Restore = "Profile.Restore";

    protected string $model = Profile::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
