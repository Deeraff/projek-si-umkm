<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $fillable = [
        'user_id', 'nama_umkm', 'logo', 'status_verifikasi'
    ];

    public function profil()
    {
        return $this->hasOne(UmkmProfil::class, 'umkm_id');
    }
}
