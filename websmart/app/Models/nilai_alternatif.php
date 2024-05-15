<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai_alternatif extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nilai_ipk',
        'nilai_sertif_prestasi',
        'nilai_sertif_organisasi',
        'nilai_tulis',
        'nilai_wawancara',
        'nilai_matkulx',
        'nilai_matkuly',
        'nilai_matkulz'
    ];
    protected $table = 'tb_nilai_alternatif';
    public $timestamps = false;
}