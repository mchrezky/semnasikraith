<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/generate', function(){
   \Illuminate\Support\Facades\Artisan::call('storage:link');
   echo 'ok';
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    //Eventslist
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/create-event/{id}', [EventController::class, 'createEventView']);
    Route::post('/create-event-submit', [EventController::class, 'createEvent']);
    Route::post('/create-event-non-submit', [EventController::class, 'createEventNon']);
    Route::get('/cart-event', [EventController::class, 'cartEventView']);
    Route::post('/delete-event', [EventController::class, 'deleteEvent']);
    Route::post('/delete-event-non', [EventController::class, 'deleteEventNon']);
    Route::get('/invoice-event', [EventController::class, 'inoviceEvent']);
    
    //Pembayaran
    Route::get('/riwayat-pembayaran', [PembayaranController::class, 'index']);
    Route::post('/create-pembayaran-submit', [PembayaranController::class, 'create']);
    Route::post('/update-pembayaran-submit', [PembayaranController::class, 'update']);
    
    //Data Event Pemakalah
    
    Route::get('/data-events', [EventController::class, 'events']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
