<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

class SharedPermissions extends BasePermissions
{
    public const Admin             = 'Admin';
    public const ReceiveNewUserSms = 'ReceiveNewUserSms';

    protected string $model = 'Shared';

    protected array $permissions = [
        'Admin',
        'ReceiveNewUserSms',
    ];

    public function __construct()
    {
        $this->groupTitle = trans('permissions.shared');
    }
}
