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
        'na_keckom',
        'na_kb',
        'na_pkb',
        'na_datmin',
        'na_kontribusi_ide',
        'lab',
        'napc_ppla',
        'napc_sd',
        'napc_paa',
        'napc_project',
        'napc_tanggung_jawab',
        'itnilai_sop',
        'itnilai_jarkom',
        'itnilai_dmj',
        'itnilai_rns',
        'itnilai_mengajar',
        'itnilai_probsolv',
        'itnilai_timemj',
        'total'
    ];
    protected $table = 'tb_nilai_akhir';
    public $timestamps = false;
}
