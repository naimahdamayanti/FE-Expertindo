<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $primaryKey = 'id';
    protected $fillable = [
        'id_sertifikasi',
        'id_public',
        'judul_training',
        'tgl_mulai',
        'tgl_selesai',
        'lokasi',
    ];

    public function sertifikasi()
    {
        return $this->belongsTo(Sertifikasi::class, 'id_sertifikasi');
    }
}
