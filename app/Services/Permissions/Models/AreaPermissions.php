<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Area;

class AreaPermissions extends BasePermissions
{
    public const All     = "Area.All";
    public const Index   = "Area.Index";
    public const Show    = "Area.Show";
    public const Store   = "Area.Store";
    public const Update  = "Area.Update";
    public const Toggle  = "Area.Toggle";
    public const Delete  = "Area.Delete";
    public const Restore = "Area.Restore";

    protected string $model = Area::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
