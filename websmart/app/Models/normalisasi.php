<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class normalisasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'norm_kriteria',
        'norm_bobot',
        'normalisasi',
        'lab'
    ];
    protected $table = 'tb_normalisasi';
    public $timestamps = false;
}
