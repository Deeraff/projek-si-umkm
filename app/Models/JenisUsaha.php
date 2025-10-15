<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUsaha extends Model
{
    use HasFactory;

    protected $table = 'kategori_jenis_usaha';

    protected $fillable = ['jenis'];

    public function usaha()
    {
        return $this->hasMany(DataUsaha::class, 'jenis_usaha_id');
    }
}
