<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class usermhs extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'password',
    ];
    protected $table = 'usermhs';
    public $timestamps = false;

    
}
