<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function kriteria(){
        return view('admin.kriteria');
    }

    public function subkriteria(){
        return view('admin.subkriteria');
    }

    public function index(){
        return view('admin.dashboard');
    }

    public function alternatif(){
        return view('admin.alternatif');
    }

    public function nilai(){
        return view('admin.nilai');
    }

    public function spk(){
        return view('admin.spk');
    }
}
