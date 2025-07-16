<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaksanaanAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'standar',
        'indikator',
        'kode',
        'temuan',
        'kepatuhan',
        'tanggapan_auditi',
        'akar_masalah',
        'dokumen',
         'tanggapan_auditor'
    ];
}
