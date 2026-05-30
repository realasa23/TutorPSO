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
    Schema::create('matakuliah', function (Blueprint $table) {
        $table->id('idmatkul'); // Primary Key
        $table->string('namamatkul', 150);
        $table->unsignedBigInteger('idkategori');
        $table->timestamps();

        // Foreign Key ke tabel kategori
        $table->foreign('idkategori')->references('idkategori')->on('kategori')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliah');
    }
};
