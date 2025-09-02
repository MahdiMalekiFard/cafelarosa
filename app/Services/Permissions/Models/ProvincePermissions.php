<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Province;

class ProvincePermissions extends BasePermissions
{
    public const All     = "Province.All";
    public const Index   = "Province.Index";
    public const Show    = "Province.Show";
    public const Store   = "Province.Store";
    public const Update  = "Province.Update";
    public const Toggle  = "Province.Toggle";
    public const Delete  = "Province.Delete";
    public const Restore = "Province.Restore";

    protected string $model = Province::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
