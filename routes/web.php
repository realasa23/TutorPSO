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
use App\Http\Controllers\loginController;


Route::get('/', [loginController::class, 'index']);
Route::get('/login', [loginController::class, 'login']);
Route::get('/register', [loginController::class, 'register']);
Route::post('/login', [loginController::class, 'handleLogin']);
Route::post('/register', [loginController::class, 'handleRegister']);
Route::get('/home', [userController::class, 'home'])->name('home');
Route::get('/search', [userController::class, 'search'])->name('search');

Route::get('/kategori', [kategoriController::class, 'kategori'])->name('kategori');
Route::get('/kategori/{id}/materi', [matakuliahController::class, 'materi'])->name('materi');
Route::get('/materi/{idmatkul}/sesi', [sesiController::class, 'listSesi'])->name('sesi');
Route::get('/tutor', [tutorController::class, 'recTutor'])->name('tutor');
Route::get('/tutor/{id}', [tutorController::class, 'profile'])->name('profiletutor');
Route::get('/tutor/{idtutor}/sesi',[tutorController::class, 'listSesi'])->name('tutor.sesi');

Route::get('/pesan-sesi/{idsesi}', [sesiController::class, 'pesanSesi'])->name('pesanan.tanggal');
Route::post('/pesan-sesi/{idsesi}', [sesiController::class, 'pilihTanggalStore'])->name('pesanan.tanggal.store');
Route::get('/pesan-sesi/{idsesi}/jam', [sesiController::class, 'pilihJam'])->name('pesanan.jam');
Route::post('/pesan-sesi/{idsesi}/jam', [sesiController::class, 'pilihJamStore'])->name('pesanan.jam.store');
Route::get('/pesan-sesi/{idsesi}/detail', [sesiController::class, 'lihatDetailPesanan'])->name('pesanan.detail');
Route::post('/konfirmasi-pesanan',[pesananController::class, 'storeRegular'])->name('pesanan.store.regular');
Route::post('/konfirmasi-trial',[pesananController::class, 'storeTrial'])->name('pesanan.store.trial');
Route::get('/gabung-sesi/{idpesanan}',[pesananController::class, 'gabungSesi'])->name('sesi.berlangsung');
Route::get('/gabung-sesi/{idpesanan}/end-call',[pesananController::class, 'endCall'])->name('sesi.end-call');

Route::get('/aktivitas', [pesananController::class, 'aktivitas'])->name('aktivitas');
Route::get('/aktivitas/detail/{idpesanan}', [pesananController::class, 'detail'])->name('aktivitas.detail');
Route::get('aktivitas/ulas/{idpesanan}', [reviewController::class, 'reviewTutor'])->name('review.create');
Route::post('aktivitas/ulas/store', [reviewController::class, 'store'])->name('review.store');
Route::post('aktivitas/laporan/store', [laporanmasalahController::class, 'store'])->name('laporan.store');
Route::get('/aktivitas/laporan/berhasil', [laporanmasalahController::class, 'laporanSukses'])->name('laporan.selesai');
Route::get('/aktivitas/laporan/{idpesanan}', [laporanmasalahController::class, 'create'])->name('laporan.create');
Route::get('/aktivitas/laporan/{idpesanan}/masalah', [laporanmasalahController::class, 'detailMasalah'])->name('laporan.detail');

Route::get('/profile', [userController::class, 'index'])->name('profile');
Route::post('/profile/update', [userController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/laporan', [refundController::class, 'processRefund'])->name('history.laporan');
Route::get('/profile/laporan/{idlaporan}', [refundController::class, 'refundSelesai'])->name('refund.selesai');
Route::post('/logout', [userController::class, 'logout'])->name('logout');