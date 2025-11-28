<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicTraining extends Model
{
    use HasFactory;
    protected $table = 'public_training';
    protected $primaryKey = 'id_public';
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_public', 'id_public');
    }

}
