<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'id_sertifikasi',
        'kategori',
        'tema',
    ];

    public function sertifikasi()
    {
        return $this->belongsTo(Sertifikasi::class, 'id_sertifikasi');
    }
}
