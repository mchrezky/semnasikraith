<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KonfirmasiPembayaranController;
use App\Http\Controllers\Admin\EventAdminController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/generate', function () {
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
    Route::post('/edit-event-submit', [EventController::class, 'editEvent']);

    //Pembayaran
    Route::get('/riwayat-pembayaran', [PembayaranController::class, 'index']);
    Route::post('/create-pembayaran-submit', [PembayaranController::class, 'create']);
    Route::post('/update-pembayaran-submit', [PembayaranController::class, 'update']);

    //Data Event Pemakalah

    Route::get('/data-events', [EventController::class, 'events']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Admin
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index']);
    Route::get('/konfirmasi-pembayaran', [KonfirmasiPembayaranController::class, 'index']);
    Route::post('/konfirmasi-pembayaran-submit', [KonfirmasiPembayaranController::class, 'update']);
    Route::get('/data-pemakalah', [EventAdminController::class, 'index']);
    Route::get('/edit-data-pemakalah/{id}', [EventAdminController::class, 'editPemakalah']);
    Route::post('/edit-pemakalah-submit', [EventAdminController::class, 'editPemakalahSubmit']);
    Route::get('/review-data-pemakalah/{id}', [EventAdminController::class, 'reviewPemakalah']);
    Route::post('/review-pemakalah-submit', [EventAdminController::class, 'reviewPemakalahSubmit']);
    Route::get('/data-non-pemakalah', [EventAdminController::class, 'index2']);
    Route::get('/edit-data-non-pemakalah/{id}', [EventAdminController::class, 'editNonPemakalah']);
    Route::post('/edit-non-pemakalah-submit', [EventAdminController::class, 'editNonPemakalahSubmit']);
    Route::get('/data-peserta', [PesertaController::class, 'index']);

    Route::get('/master-jadwal', [JadwalController::class, 'index']);
    Route::post('/edit-master-jadwal-submit', [JadwalController::class, 'update']);

    Route::get('/master-banner', [BannerController::class, 'index']);
    Route::post('/add-master-banner-submit', [BannerController::class, 'create']);
    Route::post('/edit-master-banner-submit', [BannerController::class, 'update']);
    Route::post('/delete-master-banner-submit', [BannerController::class, 'delete']);
});

require __DIR__ . '/auth.php';
