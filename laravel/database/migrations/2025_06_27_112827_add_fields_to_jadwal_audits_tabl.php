<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('jadwal_audit', function (Blueprint $table) {
            $table->time('waktu')->nullable();
            $table->string('lokasi')->nullable();
            $table->enum('status', ['Belum', 'Berlangsung', 'Selesai'])->default('Belum');
        });
    }

    public function down(): void {
        Schema::table('jadwal_audit', function (Blueprint $table) {
            $table->dropColumn(['waktu', 'lokasi', 'status']);
        });
    }
};
