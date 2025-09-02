<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Setting;

class SettingPermissions extends BasePermissions
{
    public const All     = "Setting.All";
    public const Index   = "Setting.Index";
    public const Show    = "Setting.Show";
    public const Store   = "Setting.Store";
    public const Update  = "Setting.Update";
    public const Toggle  = "Setting.Toggle";
    public const Delete  = "Setting.Delete";
    public const Restore = "Setting.Restore";

    protected string $model = Setting::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
