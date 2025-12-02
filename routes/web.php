<?php

// File: routes/web.php

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


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan route web untuk aplikasi Anda.
|
*/

// Route untuk menampilkan halaman detail sesi
Route::get('/aktivitas/detail-akan-datang', [SesiController::class, 'detailAkanDatang'])->name('sesi.detail.akan');
Route::get('/aktivitas/detail-berlangsung', [SesiController::class, 'detailBerlangsung'])->name('sesi.detail.berlangsung');
Route::get('/aktivitas/detail-lampau', [SesiController::class, 'detailLampau'])->name('sesi.detail.lampau');
Route::get('/aktivitas',[pesananController::class, 'akanDatang'])->name('aktivitas');
Route::get('/aktivitas-berlangsung',[pesananController::class, 'berlangsung'])->name('aktivitas.berlangsung');
Route::get('/aktivitas-lampau',[pesananController::class, 'lampau'])->name('aktivitas.lampau');
Route::get('/berlangsung/gabung-sesi',[pesananController::class, 'gabungSesi'])->name('sesi.berlangsung');
Route::get('/berlangsung/end-call',[pesananController::class, 'endCall'])->name('sesi.selesai');



Route::get('/list-tutor', [tutorController::class, 'listTutor'])->name('list.tutor');

// halaman pemilihan tanggal
Route::get('/pesan-sesi/{idsesi}', [SesiController::class, 'pesanSesi'])->name('pesanan.tanggal');
Route::post('/pesan-sesi/{idsesi}', [SesiController::class, 'pilihTanggalStore'])->name('pesanan.tanggal.store');

// Step 2 – Pilih Jam
Route::get('/pesan-sesi/{idsesi}/jam', [SesiController::class, 'pilihJam'])->name('pesanan.jam');

// Step 2 Store – Simpan jam ke session
Route::post('/pesan-sesi/{idsesi}/jam', [SesiController::class, 'pilihJamStore'])->name('pesanan.jam.store');

// Step 3 – Detail Pesanan
Route::get('/pesan-sesi/{idsesi}/detail', [SesiController::class, 'lihatDetailPesanan'])->name('pesanan.detail');

Route::post('/konfirmasi-pesanan',[pesananController::class, 'storeRegular'])->name('pesanan.store.regular');
Route::post('/konfirmasi-trial',[pesananController::class, 'storeTrial'])->name('pesanan.store.trial');

Route::get('/', [loginController::class, 'index'])->name('page_awal');