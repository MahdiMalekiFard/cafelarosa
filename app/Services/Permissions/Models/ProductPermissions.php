<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Product;

class ProductPermissions extends BasePermissions
{
    public const All     = "Product.All";
    public const Index   = "Product.Index";
    public const Show    = "Product.Show";
    public const Store   = "Product.Store";
    public const Update  = "Product.Update";
    public const Toggle  = "Product.Toggle";
    public const Delete  = "Product.Delete";
    public const Restore = "Product.Restore";

    protected string $model = Product::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
