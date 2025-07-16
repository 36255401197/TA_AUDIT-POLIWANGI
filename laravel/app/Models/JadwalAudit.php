<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAudit extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika nama tabel sama dengan nama model jamak)
     */
    protected $table = 'jadwal_audit';

    /**
     * Kolom-kolom yang boleh diisi (mass assignment)
     */
    
    protected $fillable = [
    'nama_kegiatan', 'tanggal_audit', 'auditor', 'auditee', 'waktu', 'lokasi', 'status'
];
}
