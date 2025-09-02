<?php

declare(strict_types=1);

use App\Models\Setting;
use App\Services\Permissions\Models\SettingPermissions;
use App\Services\Permissions\Models\SharedPermissions;

uses()->group('setting');

it('show setting', function (array $payload = [], array $expected = []) {
    Setting::factory()->create([
        'id' => 1,
    ]);

    $response = login(permissions: Arr::get($payload, 'permissions', [SharedPermissions::Admin]))->getJson('api/v1/setting/' . Arr::get($payload, 'id', 1));

    $response->assertStatus(Arr::get($expected, 'status', 200))
             ->when(Arr::has($expected, 'assertJsonStructure'))
             ->assertJsonStructure([
                 'message',
                 'data' => Arr::get($expected, 'assertJsonStructure', []),
             ])
             ->when(Arr::has($expected, 'assertJson'))
             ->assertJson(Arr::get($expected, 'assertJson'));

})->with([
    'exist item'             => [
        'payload'  => ['id' => 1],
        'expected' => ['status' => 200, 'assertJsonStructure' => ['id', 'created_at', 'updated_at'], 'assertJson' => ['data' => ['id' => 1]]],
    ],
    'not exist item'         => [
        'payload'  => ['id' => 2],
        'expected' => ['status' => 404],
    ],
    'have permission'        => [
        'payload'  => ['permissions' => [SettingPermissions::Show]],
        'expected' => ['status' => 200, 'assertJsonStructure' => ['id', 'created_at', 'updated_at'], 'assertJson' => ['data' => ['id' => 1]]],
    ],
    'doesnt have permission' => [
        'payload'  => ['permissions' => []],
        'expected' => ['status' => 403],
    ]
])->skip();
