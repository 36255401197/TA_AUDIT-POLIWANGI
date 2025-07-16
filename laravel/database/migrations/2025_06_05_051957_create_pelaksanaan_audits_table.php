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
        Schema::create('pelaksanaan_audits', function (Blueprint $table) {
        $table->id();
        $table->string('standar');
        $table->text('indikator');
        $table->string('kode');
        $table->text('temuan')->nullable();
        $table->string('kepatuhan');
        $table->text('tanggapan_auditi')->nullable();
        $table->text('akar_masalah')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaksanaan_audits');
    }
};
