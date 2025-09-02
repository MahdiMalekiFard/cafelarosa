<?php

declare(strict_types=1);

use App\Models\Page;
use App\Services\Permissions\Models\PagePermissions;
use App\Services\Permissions\Models\SharedPermissions;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function PHPUnit\Framework\assertNotNull;

uses()->group('page');

it('delete page', function (array $payload = [], array $expected = []) {
    $model = Page::factory()->create([
        'id' => 1,
    ]);

    $response = login(permissions: Arr::get($payload, 'permissions', [SharedPermissions::Admin]))->deleteJson('api/v1/page/' . Arr::get($payload, 'id', 1));

    $response->assertStatus(Arr::get($expected, 'status', 200))
             ->when(Arr::has($expected, 'assertJsonStructure'))
             ->assertJsonStructure([
                 'message',
                 'data' => Arr::get($expected, 'assertJsonStructure', []),
             ])
             ->when(Arr::has($expected, 'assertJson'))
             ->assertJson(Arr::get($expected, 'assertJson'));

    if (Arr::get($expected, 'status') === 200 && Schema::hasColumn('pages', 'deleted_at')) {
        assertDatabaseHas('pages', [
            'id' => 1,
        ]);
        assertNotNull($model->deleted_at, "page field deleted_at is null");
    } elseif (Arr::get($expected, 'status') === 200) {
        assertDatabaseMissing('pages', [
            'id' => 1,
        ]);
    } else {
        assertDatabaseHas('pages', [
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
        'payload'  => ['permissions' => [pagePermissions::Delete]],
        'expected' => ['status' => 200, 'assertJsonStructure' => [], 'assertJson' => ['data' => true]],
    ],
    'doesnt have permission' => [
        'payload'  => ['permissions' => [], 'assertJsonStructure' => [], 'assertJson' => ['message']],
        'expected' => ['status' => 403],
    ]
])->skip();
