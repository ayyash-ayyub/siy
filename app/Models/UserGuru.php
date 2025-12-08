<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGuru extends Model
{
    use HasFactory;

    protected $table = 'user_guru';

    protected $fillable = [
        'nik',
        'nama',
        'mapel',
        'nip',
        'pangkat',
        'instansi',
        'jenjang',
        'kabupaten',
        'provinsi',
    ];
}
