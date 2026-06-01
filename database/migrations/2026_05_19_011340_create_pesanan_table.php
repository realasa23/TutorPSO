<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('idpesanan');
            $table->unsignedBigInteger('idsesi');
            $table->unsignedBigInteger('userid');
            $table->date('tanggal');
            $table->string('jam');
            $table->integer('biaya');
            $table->boolean('istrial')->default(false);
            $table->string('statuspembayaran');
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
