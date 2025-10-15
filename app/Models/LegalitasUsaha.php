<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalitasUsaha extends Model
{
    use HasFactory;

    protected $table = 'legalitas_usaha';

    protected $fillable = [
        'usaha_id',
        'nib',
        'iumk',
        'sertifikat_halal',
        'sertifikat_merek',
    ];

    public function usaha()
    {
        return $this->belongsTo(DataUsaha::class, 'usaha_id');
    }
}
