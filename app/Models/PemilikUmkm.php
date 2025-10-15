<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikUmkm extends Model
{
    use HasFactory;

    protected $table = 'pemilik_umkm';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nik',
        'no_hp',
        'alamat_domisili',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usaha()
    {
        return $this->hasOne(DataUsaha::class, 'pemilik_id');
    }
}
