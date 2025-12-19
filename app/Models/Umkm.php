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
        'logo_usaha',     // ⚠️ Pastikan di database namanya 'logo_usaha', bukan 'logo'
        'jenis_usaha',    // ⚠️ Pastikan di database namanya 'jenis_usaha', bukan 'jenis_usaha_id'
        'bentuk_usaha',
        'alamat_usaha',
        'no_telp_usaha',
        'lokasi_usaha',
        'status_tempat',
        'tenaga_kerja_laki',      // ⚠️ Cek kesesuaian dengan input name="tenaga_kerja_l"
        'tenaga_kerja_perempuan', // ⚠️ Cek kesesuaian dengan input name="tenaga_kerja_p"

        // Legalitas
        'nib',
        'iumk',
        'sertifikat_halal',
        'sertifikat_merek',

        // 🔥 TAMBAHAN BARU (WAJIB ADA) 🔥
        'link_shopee',
        'link_grab',
    ];
}