<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Services\Permissions\PermissionsService;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        foreach (RoleEnum::values() as $iValue) {
            Role::updateOrCreate([
                'name'       => $iValue,
                'guard_name' => 'api',
            ]);
            Role::updateOrCreate([
                'name'       => $iValue,
                'guard_name' => 'web',
            ]);
        }

        foreach (PermissionsService::showPermissionsByService(['shop', 'crm', 'acc', 'hr']) as $iValue) {
            foreach ($iValue['items'] as $item) {
                Permission::create([
                    'name'       => $item['value'],
                    'guard_name' => 'api',
                ]);
                Permission::create([
                    'name'       => $item['value'],
                    'guard_name' => 'web',
                ]);
            }
        }

        // syncPermissions
        $admin_role = Role::whereName(RoleEnum::ADMIN->value)->first();
        $admin_role->syncPermissions(Permission::pluck('name')->toArray());
    }
}
