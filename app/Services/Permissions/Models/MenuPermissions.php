<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Menu;

class MenuPermissions extends BasePermissions
{
    public const All     = "Menu.All";
    public const Index   = "Menu.Index";
    public const Show    = "Menu.Show";
    public const Store   = "Menu.Store";
    public const Update  = "Menu.Update";
    public const Toggle  = "Menu.Toggle";
    public const Delete  = "Menu.Delete";
    public const Restore = "Menu.Restore";

    protected string $model = Menu::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
