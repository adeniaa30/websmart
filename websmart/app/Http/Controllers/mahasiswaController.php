<?php

namespace App\Http\Controllers;
use App\Models\alternatif;

use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    public function dashMahasiswa(){
        return view('mahasiswa.dashMahasiswa');
    }

    public function formlab(Request $request){
        $katakunci = $request->katakunci;
        $data = alternatif::where('nim',$katakunci);
        // $jumlahbaris = 4;

        if (strlen($katakunci)) {
            $data = alternatif::where('nim', 'like', '%' . $katakunci . '%')
                        ->orWhere('nama', 'like', '%' . $katakunci . '%')
                        ->orWhere('prodi', 'like', '%' . $katakunci . '%');
                        return view('mahasiswa.formlab', ['data' => $data]);
        } else {
            return view('mahasiswa.formlab');
        }
        // return view('mahasiswa.formlab');
    }
}
