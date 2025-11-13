<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $table = 'kategori_produk'; // nama tabel

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    // relasi ke produk (satu kategori punya banyak produk)
    public function produk()
    {
        return $this->hasMany(DataProduk::class, 'kategori_id');
    }
}
