<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPenilaian extends Model
{
    use HasFactory;

    protected $table = 'hasil_penilaian';

    protected $fillable = [
        'user_guru_id',
        'instansi',
        'posisi_dilamar',
        'nilai_profile_dan_kepribadian',
        'nilai_pedagogy',
        'nilai_teknologi_dan_desain',
        'nilai_asesmen_dan_sosial',
        'total',
        'catatan_khusus',
        'namapenilai1',
        'namapenilai2',
        'namapenilai3',
        'namapenilai4',
    ];

    public function userGuru()
    {
        return $this->belongsTo(UserGuru::class);
    }
}
