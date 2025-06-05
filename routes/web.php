<?php

use App\Livewire\Batch;
use App\Livewire\Campus;
use Livewire\Livewire;
use App\Livewire\Dashboard;
// use App\Livewire\CreatePost;
use Illuminate\Support\Facades\Route;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire-alpine-bootstrap/public/livewire/update', $handle);
});
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/show-campus', Campus::class)->name('show_campus');
        Route::get('/show-batches', Batch::class)->name('show_batches');
    });
});