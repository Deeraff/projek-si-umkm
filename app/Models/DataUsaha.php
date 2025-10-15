<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUsaha extends Model
{
    use HasFactory;

    protected $table = 'data_usaha';

    protected $fillable = [
        'pemilik_id',
        'nama_usaha',
        'jenis_usaha_id',
        'bentuk_usaha',
        'alamat_usaha',
        'desa_kelurahan',
        'kecamatan',
        'kota_kabupaten',
        'status_tempat',
    ];

    public function pemilik()
    {
        return $this->belongsTo(PemilikUmkm::class, 'pemilik_id');
    }

    public function jenisUsaha()
    {
        return $this->belongsTo(JenisUsaha::class, 'jenis_usaha_id');
    }

    public function legalitas()
    {
        return $this->hasOne(LegalitasUsaha::class, 'usaha_id');
    }
}
