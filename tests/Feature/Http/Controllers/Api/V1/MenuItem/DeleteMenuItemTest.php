<?php

declare(strict_types=1);

use App\Models\MenuItem;
use App\Services\Permissions\Models\MenuItemPermissions;
use App\Services\Permissions\Models\SharedPermissions;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function PHPUnit\Framework\assertNotNull;

uses()->group('menuItem');

it('delete menuItem', function (array $payload = [], array $expected = []) {
    $model = MenuItem::factory()->create([
        'id' => 1,
    ]);

    $response = login(permissions: Arr::get($payload, 'permissions', [SharedPermissions::Admin]))->deleteJson('api/v1/menu-item/' . Arr::get($payload, 'id', 1));

    $response->assertStatus(Arr::get($expected, 'status', 200))
             ->when(Arr::has($expected, 'assertJsonStructure'))
             ->assertJsonStructure([
                 'message',
                 'data' => Arr::get($expected, 'assertJsonStructure', []),
             ])
             ->when(Arr::has($expected, 'assertJson'))
             ->assertJson(Arr::get($expected, 'assertJson'));

    if (Arr::get($expected, 'status') === 200 && Schema::hasColumn('menu_items', 'deleted_at')) {
        assertDatabaseHas('menu_items', [
            'id' => 1,
        ]);
        assertNotNull($model->deleted_at, "menuItem field deleted_at is null");
    } elseif (Arr::get($expected, 'status') === 200) {
        assertDatabaseMissing('menu_items', [
            'id' => 1,
        ]);
    } else {
        assertDatabaseHas('menu_items', [
            'id' => 1,
        ]);
    }

})->with([
    'exist item'             => [
        'payload'  => ['id' => 1],
        'expected' => ['status' => 200, 'assertJsonStructure' => [], 'assertJson' => ['data' => true]],
    ],
    'not exist item'         => [
        'payload'  => ['id' => 2],
        'expected' => ['status' => 404],
    ],
    'have permission'        => [
        'payload'  => ['permissions' => [menuItemPermissions::Delete]],
        'expected' => ['status' => 200, 'assertJsonStructure' => [], 'assertJson' => ['data' => true]],
    ],
    'doesnt have permission' => [
        'payload'  => ['permissions' => [], 'assertJsonStructure' => [], 'assertJson' => ['message']],
        'expected' => ['status' => 403],
    ]
])->skip();
