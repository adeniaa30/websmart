<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    public function dashMahasiswa(){
        return view('mahasiswa.dashMahasiswa');
    }

    public function formlab(){
        return view('mahasiswa.formlab');
    }
}
