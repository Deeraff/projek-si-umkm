<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalOperasional extends Model
{
    use HasFactory;

    protected $table = 'jadwal_operasionals';

    protected $fillable = [
        'data_usaha_id',
        'jam_buka',
        'jam_tutup',
        'hari_libur',
    ];

    // Relasi balik (Opsional)
    public function usaha()
    {
        return $this->belongsTo(DataUsaha::class, 'data_usaha_id');
    }
}