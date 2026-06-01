<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refund', function (Blueprint $table) {
            $table->id('idrefund'); 
            $table->unsignedBigInteger('idlaporan'); 
            $table->string('statusrefund')->default('Pending'); 
            $table->bigInteger('jumlahpengembalian')->nullable(); 
            
            $table->timestamps();
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
