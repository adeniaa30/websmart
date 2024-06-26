<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiakhir_rpl extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'nama',
        'lab',
        'algo1',
        'pbo',
        'sql',
        'pweb',
        'paa',
        'uiux',
        'ood',
        'algo2',
        'pmobile',
        'sbd',
        'tkti',
        'adpl',
        'mpti',
        'ppla',
        'visi',
        'wawasan',
        'komitmen',
        'fairness',
        'teamwork',
        'potensi',
        'analisis',
        'technical',
        'portofolio',
        'total',
        'status'

    ];
    protected $table = 'tb_nilaiakhir_rpl';
    public $timestamps = false;
}
