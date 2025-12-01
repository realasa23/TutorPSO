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
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\PageController; // Import PageController baru

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
  CHAT PAGE (Via PageController)
======================= */
Route::get('/chat', [PageController::class, 'chat'])
    ->name('chat');


/* =======================
  PROFILE PAGE (BARU) (Via PageController)
======================= */
Route::get('/profile', [PageController::class, 'profile'])
    ->name('profile');

/* =======================
  LAPORAN & REFUND
======================= */
Route::get('/aktivitas/lapor', [laporanmasalahController::class, 'pageLaporan'])->name('laporan.index');
Route::get('/aktivitas/detail-masalah', [laporanmasalahController::class, 'detailMasalah'])->name('laporan.detail');
Route::post('/aktivitas/proses-refund', [laporanmasalahController::class, 'prosesRefund'])->name('laporan.store');
Route::get('/aktivitas/laporan-sukses', [laporanmasalahController::class, 'laporanSukses'])->name('laporan.sukses');
Route::get('/aktivitas/refund-sukses', [refundController::class, 'refundSukses'])->name('refund.sukses');
Route::get('/profile/laporan', [userController::class, 'historyLaporan'])->name('profile.laporan');

/* =======================
  REVIEW TUTOR
======================= */
Route::get('/review-tutor', [reviewController::class, 'reviewTutor'])->name('review.create');
Route::post('/review-tutor/simpan', [reviewController::class, 'store'])->name('review.store');
Route::get('/review-tutor/selesai', [reviewController::class, 'reviewSelesai'])->name('review.selesai');

/* =======================
  LOGIN & REGISTER
======================= */
Route::get('/', [logincontroller::class, 'index']);
Route::get('/login', [logincontroller::class, 'login']);
Route::get('/register', [logincontroller::class, 'register']);

Route::post('/login', [logincontroller::class, 'handleLogin']);
Route::post('/register', [logincontroller::class, 'handleRegister']);

/* =======================
  HALAMAN UTAMA (Via PageController)
======================= */

/* =======================
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
======================= */

Route::get('/home', [PageController::class, 'index'])
    ->name('home');

/* =======================
  FITUR PENCARIAN (Via PageController)
======================= */

/* =======================
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
======================= */

Route::get('/pencarian', [PageController::class, 'search'])
    ->name('pencarian');

/* =======================
  HALAMAN KATEGORI (Via PageController)
======================= */

/* =======================
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
======================= */

Route::get('/kategori', [PageController::class, 'category'])
    ->name('kategori');

/* =======================
  LIST TUTOR (Via PageController)
======================= */

/* =======================
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
======================= */

Route::get('/list-tutor', [PageController::class, 'listTutor'])
    ->name('listutor');

// Tambahkan route ini agar link "Pesan Sesi" di list tutor tidak error
Route::get('/profiletutor', [tutorController::class, 'profile'])->name('profiletutor');

Route::get('/profiletutor', [PageController::class, 'profile'])->name('profiletutor');
