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
    Schema::create('jadwal_audit', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('posisi');
        $table->date('tanggal_audit');
        // $table->timestamps(); // Kalau kamu ingin timestamps, bisa ditambahkan
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_audit');
    }
};
