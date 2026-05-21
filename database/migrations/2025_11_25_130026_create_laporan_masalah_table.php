<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Cek dulu: Apakah tabel 'laporanmasalah' SUDAH ADA?
        // Jika BELUM ADA (!), baru kita buat.
        if (!Schema::hasTable('laporanmasalah')) {
            Schema::create('laporanmasalah', function (Blueprint $table) {
                $table->id('idlaporan');
                $table->unsignedBigInteger('userid')->nullable();
                $table->unsignedBigInteger('idpesanan')->nullable();
                $table->string('kategorimasalah');
                $table->text('deskripsimasalah');
                $table->string('statuslaporan')->default('Pending');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_masalah');
    }
};
