<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Country;

class CountryPermissions extends BasePermissions
{
    public const All     = "Country.All";
    public const Index   = "Country.Index";
    public const Show    = "Country.Show";
    public const Store   = "Country.Store";
    public const Update  = "Country.Update";
    public const Toggle  = "Country.Toggle";
    public const Delete  = "Country.Delete";
    public const Restore = "Country.Restore";

    protected string $model = Country::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
