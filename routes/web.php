<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\laporanmasalahController;
use App\Http\Controllers\matakuliahController;
use App\Http\Controllers\refundController;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\tutorController;
use App\Http\Controllers\userController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Di sini Anda dapat mendaftarkan route web untuk aplikasi Anda.
*/


/* =======================
   DETAIL SESI
======================= */
Route::get('/aktivitas/detail-akan-datang', [SesiController::class, 'detailAkanDatang'])
    ->name('sesi.detail.akan');

Route::get('/aktivitas/detail-berlangsung', [SesiController::class, 'detailBerlangsung'])
    ->name('sesi.detail.berlangsung');

Route::get('/aktivitas/detail-lampau', [SesiController::class, 'detailLampau'])
    ->name('sesi.detail.lampau');


/* =======================
   AKTIVITAS LIST
======================= */
Route::get('/aktivitas', [pesananController::class, 'index'])
    ->name('aktivitas');

Route::get('/aktivitas-berlangsung', [pesananController::class, 'berlangsung'])
    ->name('aktivitas.berlangsung');

Route::get('/aktivitas-lampau', [pesananController::class, 'lampau'])
    ->name('aktivitas.lampau');


/* =======================
   GABUNG SESI
======================= */
Route::get('/berlangsung/gabung-sesi', [pesananController::class, 'gabungSesi'])
    ->name('sesi.berlangsung');

Route::get('/berlangsung/end-call', [pesananController::class, 'endCall'])
    ->name('sesi.selesai');


/* =======================
   PESANAN
======================= */
Route::get('/pesanan/detail-pesanan', [SesiController::class, 'lihatDetailPesanan'])
    ->name('pesanan.detail');

Route::get('/pesan-sesi', [SesiController::class, 'pesanSesi'])
    ->name('pesanan.pesan');

Route::get('/pesan-sesi/jadwal', [SesiController::class, 'pesanJamSesi'])
    ->name('pesanan.jam');

Route::get('/konfirmasi-pesanan', [pesananController::class, 'berhasilPesan'])
    ->name('pesanan.berhasil');

Route::get('/konfirmasi-trial', [pesananController::class, 'berhasilTrial'])
    ->name('trial.berhasil');


/* =======================
   CHAT PAGE
======================= */
Route::get('/chat', function () {
    return view('Chat');   // resources/views/Chat.blade.php
})->name('chat');


/* =======================
   PROFILE PAGE (BARU)
======================= */
Route::get('/profile', function () {
    return view('Profile');   // resources/views/Profile.blade.php
})->name('profile');
