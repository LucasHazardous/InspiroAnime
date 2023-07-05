<?php

use App\Http\Controllers\Api\V1\ApiV1AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(ApiV1AuthController::class)
    ->prefix('/v1/auth')
    ->name('api.auth.')
    ->group(function () {
    Route::post('/sign-in', 'signIn')->name('signIn');
});

Route::middleware('auth:sanctum')->controller(ApiV1AuthController::class)
    ->prefix('/v1/auth')
    ->name('api.auth.')
    ->group(function () {
       Route::post('/sign-out', 'signOut')->name('signOut');
});
