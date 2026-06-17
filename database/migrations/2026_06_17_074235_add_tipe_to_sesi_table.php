<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sesi', function (Blueprint $table) {
            $table->string('tipe')->default('online')->after('harga');
        });
    }

    public function down(): void
    {
        Schema::table('sesi', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};