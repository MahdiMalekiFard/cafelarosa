<?php

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'api/v1', 'middleware' => ['cors', 'json.response'], 'as' => 'api.v1.'], function () {
    $path = __DIR__ . '/api';
    foreach (array_diff(scandir($path, SCANDIR_SORT_NONE), ['.', '..']) as $file) {
        require "api/{$file}";
    }
});
