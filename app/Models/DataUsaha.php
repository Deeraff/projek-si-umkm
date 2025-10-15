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
        'logo',
        'jenis_usaha_id',
        'bentuk_usaha',
        'alamat_usaha',
        'latitude',
        'longitude',
        'no_telp_usaha',
        'status_tempat',
        'tenaga_kerja_l',
        'tenaga_kerja_p',
        'status_umkm',
    ];

    public function pemilik()
    {
        return $this->belongsTo(PemilikUmkm::class, 'pemilik_id');
    }

    public function jenisUsaha()
    {
        return $this->belongsTo(KategoriJenisUsaha::class, 'jenis_usaha_id');
    }

    public function legalitasUsaha()
    {
        return $this->hasOne(LegalitasUsaha::class, 'usaha_id');
    }
    
}
