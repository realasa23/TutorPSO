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
    Schema::create('refund', function (Blueprint $table) {
        $table->id('idrefund');
        $table->unsignedBigInteger('idlaporan');
        $table->string('statusrefund', 50);
        $table->integer('jumlahpengembalian');
        $table->timestamps();

        // Foreign Key nyambung ke tabel laporanmasalah
        $table->foreign('idlaporan')->references('idlaporan')->on('laporanmasalah')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund');
    }
};
