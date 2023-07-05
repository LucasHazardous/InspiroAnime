<?php

use App\Http\Livewire\DeleteInspirationForm;
use App\Http\Livewire\InspirationView;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('inspirations')->name('inspirations.')->group(function() {
    Route::get('/', InspirationView::class)->name('index');
    Route::get('/{inspiration}/delete', DeleteInspirationForm::class)->name('delete');
});