<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Service;

class ServicePermissions extends BasePermissions
{
    public const All     = "Service.All";
    public const Index   = "Service.Index";
    public const Show    = "Service.Show";
    public const Store   = "Service.Store";
    public const Update  = "Service.Update";
    public const Toggle  = "Service.Toggle";
    public const Delete  = "Service.Delete";
    public const Restore = "Service.Restore";

    protected string $model = Service::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
