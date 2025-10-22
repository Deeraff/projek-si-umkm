<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriJenisUsaha extends Model
{
    use HasFactory;

    protected $table = 'kategori_jenis_usaha';

    protected $fillable = [
        'nama_jenis', 
        'deskripsi',
    ];

    // relasi: satu kategori punya banyak usaha
    public function usaha()
    {
        return $this->hasMany(DataUsaha::class, 'jenis_usaha_id');
    }
}
