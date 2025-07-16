<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanHasil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_auditee',
        'unit',
        'tanggal_audit',
        'status',
        'catatan',
        'file',
    ];
}
