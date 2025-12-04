<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ✅ TAMBAHAN BARU 1: Import Model Jadwal
use App\Models\JadwalOperasional;

class DataUsaha extends Model
{
    use HasFactory;

    protected $table = 'data_usaha';

    // Bagian ini TIDAK DIUBAH (tetap sama seperti punya Anda)
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
        'alasan_tolak',
    ];

    // Fungsi-fungsi lama ini TIDAK DIUBAH
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
    
    public function produk()
    {
        return $this->hasMany(DataProduk::class, 'usaha_id');
    }

    /**
     * ✅ TAMBAHAN BARU 2: FUNGSI JADWAL
     * Hanya fungsi ini yang saya tambahkan agar bisa memanggil jadwal operasional.
     */
    public function jadwal()
    {
        return $this->hasOne(JadwalOperasional::class, 'data_usaha_id');
    }

}