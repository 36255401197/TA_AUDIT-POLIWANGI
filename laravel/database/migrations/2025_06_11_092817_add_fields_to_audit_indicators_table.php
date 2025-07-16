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
        Schema::table('audit_indicators', function (Blueprint $table) {
        $table->string('kode')->nullable();
        $table->text('temuan')->nullable();
        $table->string('kepatuhan')->nullable(); // SESUAI / TIDAK SESUAI
        $table->text('tanggapan_auditee')->nullable();
        $table->text('akar_masalah')->nullable();
        $table->string('link_pdf')->nullable(); // URL bukti dari Auditee
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_indicators', function (Blueprint $table) {
            //
        });
    }
};
