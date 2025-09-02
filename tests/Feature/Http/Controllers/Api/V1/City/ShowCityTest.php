<?php

declare(strict_types=1);

use App\Models\City;
use App\Services\Permissions\Models\CityPermissions;
use App\Services\Permissions\Models\SharedPermissions;

uses()->group('city');

it('show city', function (array $payload = [], array $expected = []) {
    City::factory()->create([
        'id' => 1,
    ]);

    $response = login(permissions: Arr::get($payload, 'permissions', [SharedPermissions::Admin]))->getJson('api/v1/city/' . Arr::get($payload, 'id', 1));

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
        'payload'  => ['permissions' => [CityPermissions::Show]],
        'expected' => ['status' => 200, 'assertJsonStructure' => ['id', 'created_at', 'updated_at'], 'assertJson' => ['data' => ['id' => 1]]],
    ],
    'doesnt have permission' => [
        'payload'  => ['permissions' => []],
        'expected' => ['status' => 403],
    ]
])->skip();
