<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'in_house_training';

    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'isi',
        'tgl_rilis',
        'gambar'
    ];
}
