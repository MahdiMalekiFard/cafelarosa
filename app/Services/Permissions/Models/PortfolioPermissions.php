<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Portfolio;

class PortfolioPermissions extends BasePermissions
{
    public const All     = "Portfolio.All";
    public const Index   = "Portfolio.Index";
    public const Show    = "Portfolio.Show";
    public const Store   = "Portfolio.Store";
    public const Update  = "Portfolio.Update";
    public const Toggle  = "Portfolio.Toggle";
    public const Delete  = "Portfolio.Delete";
    public const Restore = "Portfolio.Restore";

    protected string $model = Portfolio::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
