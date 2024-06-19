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
        'nilai_keckom',
        'nilai_kb',
        'nilai_pkb',
        'nilai_datmin',
        'lab',
        'nilai_kontribusi_ide',
        'nilaipc_tanggungjawab',
        'nilaipc_project',
        'nilaipc_pengalaman',
        'nilaipc_ppla',
        'nilaipc_sd',
        'nilaipc_paa',
        'itnilai_sop',
        'itnilai_jarkom',
        'itnilai_dmj',
        'itnilai_rns',
        'itnilai_mengajar',
        'itnilai_probsolv',
        'itnilai_timemj',
        'status'
    ];
    protected $table = 'tb_nilai_alternatif';
    public $timestamps = false;
}
