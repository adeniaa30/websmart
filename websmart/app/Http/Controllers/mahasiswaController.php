<?php

namespace App\Http\Controllers;
use App\Models\alternatif;
use App\Models\Lab;
use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    public function dashMahasiswa(Request $request){
        $katakunci = $request->katakunci;
        $distinct_nama_lab = Lab::distinct('nama_lab')->pluck('nama_lab');
        // Retrieve data from the database
        $dataQuery = alternatif::query(); // Initialize query builder

        if (strlen($katakunci)) {
            $dataQuery->where('nim', 'like', '%' . $katakunci . '%')
                    ->orWhere('nama', 'like', '%' . $katakunci . '%')
                    ->orWhere('prodi', 'like', '%' . $katakunci . '%');
        }

        // Execute the query and retrieve data
        $alternatifData = $dataQuery->get();
        // Pass the retrieved data to the view
        // dd($distinct_nama_lab);
        return view('mahasiswa.dashMahasiswa', ['distinct_nama_lab' => $distinct_nama_lab]);
    }

    public function formlab(Request $request){
        $katakunci = $request->katakunci;
        $data = alternatif::where('nim',$katakunci);
        // $jumlahbaris = 4;
        return view('mahasiswa.formlab');
        
        // return view('mahasiswa.formlab');
    }

    public function showform(Request $request){
        $katakunci = $request->katakunci;
        $distinct_nama_lab = Lab::distinct('nama_lab')->pluck('nama_lab');

        // Retrieve data from the database
        $dataQuery = alternatif::query(); // Initialize query builder

        if (strlen($katakunci)) {
            $dataQuery->where('nim', 'like', '%' . $katakunci . '%')
                    ->orWhere('nama', 'like', '%' . $katakunci . '%')
                    ->orWhere('prodi', 'like', '%' . $katakunci . '%');
        }

        // Execute the query and retrieve data
        $alternatifData = $dataQuery->get();

        // Pass the retrieved data to the view
        return view('mahasiswa.showform', ['alternatifData' => $alternatifData, 'distinct_nama_lab' => $distinct_nama_lab]);
    }

    
}
