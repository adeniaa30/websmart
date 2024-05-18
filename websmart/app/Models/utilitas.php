<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class utilitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'uti_ipk',
        'uti_sertif_prestasi',
        'uti_sertif_organisasi',
        'uti_tulis',
        'uti_wawancara',
        'uti_keckom',
        'uti_kb',
        'uti_pkb',
        'uti_datmin',
        'uti_kontribusi_ide',
        'lab',
        'utipc_ppla',
        'utipc_sd',
        'utipc_paa',
        'utipc_tanggung_jawab',
        'utipc_project'
    ];
    protected $table = 'tb_utilitas';
    public $timestamps = false;
}
