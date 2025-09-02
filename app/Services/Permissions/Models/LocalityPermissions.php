<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Locality;

class LocalityPermissions extends BasePermissions
{
    public const All     = "Locality.All";
    public const Index   = "Locality.Index";
    public const Show    = "Locality.Show";
    public const Store   = "Locality.Store";
    public const Update  = "Locality.Update";
    public const Toggle  = "Locality.Toggle";
    public const Delete  = "Locality.Delete";
    public const Restore = "Locality.Restore";

    protected string $model = Locality::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
