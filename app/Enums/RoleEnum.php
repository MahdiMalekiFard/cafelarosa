<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleEnum: string
{
    use EnumToArray;
    case DEVELOPER   = 'developer';
    case ADMIN       = 'admin';
    case MARKETER    = 'marketer';
    case CRM_ADMIN   = 'crm_admin';
    case CRM_MANAGER = 'crm_manager';
}
