<?php

declare(strict_types=1);

namespace App\Services\Permissions\Models;

use Illuminate\Support\Str;

class BasePermissions
{
    protected string $model       = '';
    protected ?string $groupTitle = null;

    protected array $permissions       = [
        'All',
        'Index',
        'Show',
        'Store',
        'Update',
        'Toggle',
        'Delete',
        'Restore',
    ];
    protected array $otherTranslations = [];

    public function all(): array
    {
        $mm = str_replace('\\', '/', $this->model);
        $prefix = basename($mm);

        return [
            'group' => $prefix,
            'title' => $this->groupTitle ?? trans('permissions.management', ['attribute' => trans(Str::camel($prefix) . '.model')]),
            'items' => array_map(fn ($permission) => [
                'title' => $this->title($permission),
                'value' => $prefix . '.' . Str::studly($permission),
            ], $this->permissions),
        ];
    }

    public function title(string $permission): string
    {
        $type = str_replace('\\', '/', $this->model);
        $type = basename($type);

        return array_merge([
            "{$type}.All"     => trans('permissions.All'),
            "{$type}.Index"   => trans('permissions.Index'),
            "{$type}.Show"    => trans('permissions.Show'),
            "{$type}.Store"   => trans('permissions.Store'),
            "{$type}.Update"  => trans('permissions.Update'),
            "{$type}.Toggle"  => trans('permissions.Toggle'),
            "{$type}.Delete"  => trans('permissions.Delete'),
            "{$type}.Restore" => trans('permissions.Restore'),
        ], $this->otherTranslations)[$type . '.' . $permission] ?? '';
    }
}
