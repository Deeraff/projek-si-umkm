<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $fillable = [
        // Data Pemilik
        'nama_pemilik',
        'nik',
        'no_kk',
        'npwp',
        'no_hp',
        'email',
        'alamat_domisili',

        // Data Usaha
        'nama_usaha',
        'logo_usaha',
        'jenis_usaha',
        'bentuk_usaha',
        'alamat_usaha',
        'no_telp_usaha',
        'lokasi_usaha',
        'status_tempat',
        'tenaga_kerja_laki',
        'tenaga_kerja_perempuan',

        // Legalitas
        'nib',
        'iumk',
        'sertifikat_halal',
        'sertifikat_merek',
    ];
}
