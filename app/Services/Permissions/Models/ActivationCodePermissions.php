<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\ActivationCode;

class ActivationCodePermissions extends BasePermissions
{
    public const All     = "ActivationCode.All";
    public const Index   = "ActivationCode.Index";
    public const Show    = "ActivationCode.Show";
    public const Store   = "ActivationCode.Store";
    public const Update  = "ActivationCode.Update";
    public const Toggle  = "ActivationCode.Toggle";
    public const Delete  = "ActivationCode.Delete";
    public const Restore = "ActivationCode.Restore";

    protected string $model = ActivationCode::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
