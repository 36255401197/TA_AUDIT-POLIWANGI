<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelaporan_hasils', function (Blueprint $table) {
        $table->id();
        $table->string('nama_auditee');
        $table->string('unit');
        $table->date('tanggal_audit');
        $table->enum('status', ['Belum Dibaca', 'Ditindaklanjuti', 'Selesai'])->default('Belum Dibaca');
        $table->text('catatan')->nullable();
        $table->string('file')->nullable();
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan_hasils');
    }
};
