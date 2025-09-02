<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use App\Models\Contact;

class ContactPermissions extends BasePermissions
{
    public const All     = "Contact.All";
    public const Index   = "Contact.Index";
    public const Show    = "Contact.Show";
    public const Store   = "Contact.Store";
    public const Update  = "Contact.Update";
    public const Toggle  = "Contact.Toggle";
    public const Delete  = "Contact.Delete";
    public const Restore = "Contact.Restore";

    protected string $model = Contact::class;
    /*
     * this adds automatic from BasePermissions if you have other permission override this.
     * protected static array $permissions = ['All',''Index', 'Show', 'Store', 'Update', 'Toggle', 'Delete', 'Restore'];
     */
}
