<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    use HasFactory;

    protected $table = 'data_produk';

    protected $fillable = [
        'usaha_id',
        'kategori_id', // ✅ tambahkan ini
        'nama_produk',
        'deskripsi',
        'harga',
        'foto_produk',
        'status_produk', // pastikan pakai nama kolom yang benar di database
    ];


    public function usaha()
    {
        return $this->belongsTo(DataUsaha::class, 'usaha_id');
    }
    public function produk()
    {
        return $this->hasMany(DataProduk::class, 'usaha_id');
    }

    public function pemilik()
    {
        return $this->belongsTo(PemilikUmkm::class, 'pemilik_id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

}
