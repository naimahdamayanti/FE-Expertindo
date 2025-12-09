<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'tgl_rilis',
        'gambar',
        'isi'
        
    ];
}
