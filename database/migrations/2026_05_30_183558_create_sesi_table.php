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
    if (!Schema::hasTable('sesi')) {
    Schema::create('sesi', function (Blueprint $table) {
        $table->id('idsesi'); // Primary Key
        $table->unsignedBigInteger('idtutor');
        $table->unsignedBigInteger('idmatkul');
        $table->string('namaSesi', 150);
        $table->integer('harga');
        $table->timestamps();

        // Foreign Keys
        $table->foreign('idtutor')->references('idtutor')->on('tutor')->onDelete('cascade');
        $table->foreign('idmatkul')->references('idmatkul')->on('matakuliah')->onDelete('cascade');
    });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi');
    }
};
