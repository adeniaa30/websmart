<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai_akhir extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'na_ipk',
        'na_sertif_prestasi',
        'na_sertif_organisasi',
        'na_tulis',
        'na_wawancara',
        'na_matkulx',
        'na_matkuly',
        'na_matkulz'
    ];
    protected $table = 'tb_nilai_akhir';
    public $timestamps = false;
}
