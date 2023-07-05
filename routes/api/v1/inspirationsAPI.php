<?php

use App\Http\Controllers\Api\V1\ApiV1InspirationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->controller(ApiV1InspirationController::class)
->prefix("/v1/inspirations")
->name("api.inspirations")
->group(function() {
    Route::get("/", "index")->name("index");
    Route::post("/", "generate")->name("generate");
    Route::get("/{inspiration}", "show")->name("show");
    Route::delete("/{inspiration}", "destroy")->name("destroy");
});