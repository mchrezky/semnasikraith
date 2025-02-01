<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    //Events
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/create-event/{id}', [EventController::class, 'createEventView']);
    Route::post('/create-event-submit', [EventController::class, 'createEvent']);
    Route::post('/create-event-non-submit', [EventController::class, 'createEventNon']);
    Route::get('/cart-event', [EventController::class, 'cartEventView']);
    Route::post('/delete-event', [EventController::class, 'deleteEvent']);
    Route::post('/delete-event-non', [EventController::class, 'deleteEventNon']);
    Route::get('/invoice-event', [EventController::class, 'inoviceEvent']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
