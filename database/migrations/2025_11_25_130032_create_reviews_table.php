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
    // Cek apakah tabel 'review' SUDAH ADA?
    // Jika BELUM ADA (!), baru buat.
    if (!Schema::hasTable('review')) {
        Schema::create('review', function (Blueprint $table) {
            $table->id('idreview'); 
            $table->unsignedBigInteger('idpesanan')->nullable();
            $table->integer('rating');
            $table->string('tagpenilaian')->nullable(); 
            $table->text('komentar')->nullable();
            $table->dateTime('tanggalreview')->useCurrent();
            $table->timestamps(); 
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
