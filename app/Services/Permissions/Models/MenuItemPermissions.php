<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\MenuItem;

class MenuItemPermissions extends BasePermissions
{
    public const All     = "MenuItem.All";
    public const Index   = "MenuItem.Index";
    public const Show    = "MenuItem.Show";
    public const Store   = "MenuItem.Store";
    public const Update  = "MenuItem.Update";
    public const Toggle  = "MenuItem.Toggle";
    public const Delete  = "MenuItem.Delete";
    public const Restore = "MenuItem.Restore";

    protected string $model = MenuItem::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
