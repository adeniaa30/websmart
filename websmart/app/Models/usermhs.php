<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usermhs extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'password',
    ];
    protected $table = 'usermhs';
    public $timestamps = false;
}
