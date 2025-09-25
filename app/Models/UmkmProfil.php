<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmProfil extends Model
{
    protected $table = 'umkm_profil';
    protected $fillable = [
        'umkm_id', 'jenis_usaha', 'bentuk_usaha', 'alamat_usaha', 'telepon_usaha',
        'desa_kelurahan', 'kecamatan', 'kota_kabupaten', 'status_tempat',
        'tenaga_kerja_laki', 'tenaga_kerja_perempuan', 'deskripsi', 'foto',
        'latitude', 'longitude'
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }
}

