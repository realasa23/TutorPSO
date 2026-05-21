<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesi', function (Blueprint $table) {
            $table->id('idsesi');
            $table->unsignedBigInteger('idtutor');
            $table->unsignedBigInteger('idmatkul');
            $table->string('namaSesi');
            $table->integer('harga');
            $table->text('deskripsi')->nullable();
            $table->string('filemateri')->nullable();
            $table->string('rekamankelas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesi');
    }
};
