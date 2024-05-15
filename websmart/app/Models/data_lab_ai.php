<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_lab_ai extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'ipk',
        'lab',
        'sertif_prestasi',
        'sertif_organisasi',
        'nilai_matkulx',
        'nilai_matkuly',
        'nilai_matkulz',
        'ide_project'
    ];
    protected $table = 'tb_data_lab_ai';
    public $timestamps = false;
}
