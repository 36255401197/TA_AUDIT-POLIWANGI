<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AuditIndicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'indikator',
        'kode',
        'checklist',
        'dokumen'
    ];

    protected $casts = [
        'checklist' => 'boolean',
    ];
}

// class AuditIndicator extends Model
// {
    
//     protected $fillable = ['kategori', 'indikator', 'is_checked', 'kode'];
// }