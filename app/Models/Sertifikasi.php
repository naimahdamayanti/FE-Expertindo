<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
    use HasFactory;

    protected $table = 'sertifikasi';
    protected $primaryKey = 'id_sertifikasi';
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_sertifikasi', 'id_sertifikasi');
    }
}
