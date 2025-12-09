<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    use HasFactory;

    protected $table = 'konsultan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'isi',
        'gambar'
    ];
}
