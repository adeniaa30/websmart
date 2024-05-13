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
        'uti_matkulx',
        'uti_matkuly',
        'uti_matkulz',
    ];
    protected $table = 'tb_utilitas';
    public $timestamps = false;
}
