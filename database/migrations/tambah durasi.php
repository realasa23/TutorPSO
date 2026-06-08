<?php
// Jalankan: php artisan make:migration add_durasi_to_pesanan_table
// Lalu isi dengan ini:

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            // Tambah kolom durasi (1 atau 2 jam) setelah kolom jam
            $table->integer('durasi')->default(1)->after('jam');
        });
    }

    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn('durasi');
        });
    }
};