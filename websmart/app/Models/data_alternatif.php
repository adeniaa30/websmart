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
        'da_organisasi',
        'status_org',
        'khs',
        'da_nilai_tulis',
        'da_nilai_wawancara',
        'nilai_keckom',
        'nilai_kb',
        'nilai_pkb',
        'nilai_datmin',
        'ide_project',
        'pc_tanggung_jawab',
        'pc_link_project',
        'pc_ppla',
        'pc_sd',
        'pc_paa',
        'it_pengalaman',
        'itnilai_sop',
        'itnilai_jarkom',
        'itnilai_dmj',
        'itnilai_rns',
        'itnilai_mengajar',
        'itnilai_probsolv',
        'itnilai_timemj'
    ];
    protected $table = 'tb_data_alternatif';
    public $timestamps = false;
}
