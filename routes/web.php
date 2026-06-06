<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanmasalahController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'handleLogin']);
Route::post('/register', [LoginController::class, 'handleRegister']);
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/search', [UserController::class, 'search'])->name('search');

Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');
Route::get('/kategori/{id}/materi', [MatakuliahController::class, 'materi'])->name('materi');
Route::get('/materi/{idmatkul}/sesi', [SesiController::class, 'listSesi'])->name('sesi');
Route::get('/tutor', [TutorController::class, 'recTutor'])->name('tutor');
Route::get('/tutor/{id}', [TutorController::class, 'profile'])->name('profiletutor');
Route::get('/tutor/{idtutor}/sesi', [TutorController::class, 'listSesi'])->name('tutor.sesi');

Route::get('/pesan-sesi/{idsesi}', [SesiController::class, 'pesanSesi'])->name('pesanan.tanggal');
Route::post('/pesan-sesi/{idsesi}', [SesiController::class, 'pilihTanggalStore'])->name('pesanan.tanggal.store');
Route::get('/pesan-sesi/{idsesi}/jam', [SesiController::class, 'pilihJam'])->name('pesanan.jam');
Route::post('/pesan-sesi/{idsesi}/jam', [SesiController::class, 'pilihJamStore'])->name('pesanan.jam.store');
Route::get('/pesan-sesi/{idsesi}/detail', [SesiController::class, 'lihatDetailPesanan'])->name('pesanan.detail');
Route::post('/konfirmasi-pesanan', [PesananController::class, 'storeRegular'])->name('pesanan.store.regular');
Route::post('/konfirmasi-trial', [PesananController::class, 'storeTrial'])->name('pesanan.store.trial');
Route::get('/gabung-sesi/{idpesanan}', [PesananController::class, 'gabungSesi'])->name('sesi.berlangsung');
Route::get('/gabung-sesi/{idpesanan}/end-call', [PesananController::class, 'endCall'])->name('sesi.end-call');

Route::get('/aktivitas', [PesananController::class, 'aktivitas'])->name('aktivitas');
Route::get('/aktivitas/detail/{idpesanan}', [PesananController::class, 'detail'])->name('aktivitas.detail');
Route::get('aktivitas/ulas/{idpesanan}', [ReviewController::class, 'reviewTutor'])->name('review.create');
Route::post('aktivitas/ulas/store', [ReviewController::class, 'store'])->name('review.store');
Route::post('aktivitas/laporan/store', [LaporanmasalahController::class, 'store'])->name('laporan.store');
Route::get('/aktivitas/laporan/berhasil', [LaporanmasalahController::class, 'laporanSukses'])->name('laporan.selesai');
Route::get('/aktivitas/laporan/{idpesanan}', [LaporanmasalahController::class, 'create'])->name('laporan.create');
Route::get('/aktivitas/laporan/{idpesanan}/masalah', [LaporanmasalahController::class, 'detailMasalah'])->name('laporan.detail');

Route::get('/profile', [UserController::class, 'index'])->name('profile');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/laporan', [RefundController::class, 'processRefund'])->name('history.laporan');
Route::get('/profile/laporan/{idlaporan}', [RefundController::class, 'refundSelesai'])->name('refund.selesai');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');