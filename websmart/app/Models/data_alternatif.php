<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_alternatif extends Model
{
    use HasFactory;
    protected $fillable = [
        'da_nim',
        'da_nama',
        'da_prodi',
        'da_ipk',
        'da_lab',
        'da_sertif_prestasi',
        'da_sertif_organisasi',
        'da_nilai_tulis',
        'da_nilai_wawancara'
    ];
    protected $table = 'tb_data_alternatif';
    public $timestamps = false;
}
