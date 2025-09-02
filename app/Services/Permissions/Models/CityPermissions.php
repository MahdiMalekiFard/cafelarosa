<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\City;

class CityPermissions extends BasePermissions
{
    public const All     = "City.All";
    public const Index   = "City.Index";
    public const Show    = "City.Show";
    public const Store   = "City.Store";
    public const Update  = "City.Update";
    public const Toggle  = "City.Toggle";
    public const Delete  = "City.Delete";
    public const Restore = "City.Restore";

    protected string $model = City::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
