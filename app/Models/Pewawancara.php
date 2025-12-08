<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pewawancara extends Model
{
    use HasFactory;

    protected $table = 'pewawancara';

    protected $fillable = [
        'nama',
        'instansi',
    ];
}
