<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria',
        'bobot',
        'lab'
    ];
    protected $table = 'tb_kriteria';
    public $timestamps = false;
}
