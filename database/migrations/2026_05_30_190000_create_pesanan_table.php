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
    if (!Schema::hasTable('pesanan')) {
    Schema::create('pesanan', function (Blueprint $table) {
        $table->id('idpesanan'); // Primary Key
        $table->unsignedBigInteger('idsesi');
        $table->unsignedBigInteger('userid'); // Menghubungkan ke tabel users (id)
        $table->date('tanggal');
        $table->string('jam', 50);
        $table->integer('biaya')->default(0);
        $table->timestamps();

        // Foreign Keys
        $table->foreign('idsesi')->references('idsesi')->on('sesi')->onDelete('cascade');
        $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
    });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
