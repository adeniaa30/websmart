<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subkriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria',
        'subkriteria',
        'nilai',
        's_lab'
    ];
    protected $table = 'tb_subkriteria';
    public $timestamps = false;
}
