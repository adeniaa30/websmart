<?php

namespace App\Http\Controllers;
use App\Models\alternatif;
use App\Models\data_alternatif;
use App\Models\data_lab_ai;
use App\Models\Lab;
use App\Models\usermhs;
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
        $nim = $request->input('nim');
        $data = usermhs::where('nim', $nim)->value('nim');
        $data = alternatif::where('nim',$katakunci);
        // $jumlahbaris = 4;
        return view('mahasiswa.formlab', ['nim' => $nim]);
        
        // return view('mahasiswa.formlab');
    }

    public function showform(Request $request){
        $nim = $request->input('nim');
        $data = usermhs::where('nim', $nim)->value('nim');
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
        return view('mahasiswa.showform', [
            'alternatifData' => $alternatifData, 
            'distinct_nama_lab' => $distinct_nama_lab,
            'nim' => $nim
        ]);
    }

    public function view_form(Request $request){
        $nim = $request->nim;
        $nama = $request->nama;
        $prodi = $request->prodi;
        $ipk = $request->ipk;
        $lab = $request->lab;
        if ($lab == 'Laboratorium Artificial Intelligence'){
            return view('mahasiswa.formlab_ai', [
                'nim'=>$nim,
                'nama'=>$nama,
                'prodi'=>$prodi,
                'ipk' => $ipk,
                'lab'=>$lab
            ]);
        }elseif($lab == 'Laboratorium Pertanian Cerdas'){
            return view('mahasiswa.formlab_ai', [
                'nim'=>$nim,
                'nama'=>$nama,
                'prodi'=>$prodi,
                'ipk' => $ipk,
                'lab'=>$lab
            ]);
        } else{
            return ('view halaman gagal.');
        }

    }

    public function submitform(Request $request){
        if($request->lab == 'Laboratorium Artificial Intelligence'){

            $request->validate([
                'sertif_lomba.*' => 'required|mimes:pdf|max:2048',
                'sertif_organisasi.*' => 'required|mimes:pdf|max:2048',
            ]);

            $pdfPathsLomba = [];
            $pdfPathsOrganisasi = [];
            if ($request->hasFile('sertif_lomba') && $request->hasFile('sertif_organisasi')) {
                foreach ($request->file('sertif_lomba') as $file) {
                    $path = $file->store('sertif_prestasi');
                    $pdfPathsLomba[] = $path;
                }
                foreach ($request->file('sertif_organisasi') as $file) {
                    $path = $file->store('sertif_organisasi');
                    $pdfPathsOrganisasi[] = $path;
                }
                foreach (array_map(null, $pdfPathsLomba, $pdfPathsOrganisasi) as [$sertifLomba, $sertifOrganisasi]){
                    
                    $data = [
                        'da_nim'=>$request->nim,
                        'da_nama'=>$request->nama,
                        'da_prodi'=>$request->prodi,
                        'da_ipk'=>$request->ipk,
                        'da_lab'=>$request->lab,
                        // 'da_sertif_prestasi'=>json_encode($filenames),
                        'da_sertif_prestasi'=>$sertifLomba,
                        'da_sertif_organisasi'=>$sertifOrganisasi,
                        'da_nilai_matkulx'=>$request->nilai_matkulx,
                        'da_nilai_matkuly'=>$request->nilai_matkuly,
                        'da_nilai_matkulz'=>$request->nilai_matkulz,
                        'ide_project'=>$request->ide
                    ];
                data_alternatif::create($data);
                    
                }
                return redirect()->route('dashmhs')->with('success', 'Data Berhasil Ditambahkan!');
            }
                
        }elseif($request->lab == 'Laboratorium Pertanian Cerdas'){
            $request->validate([
                'sertif_lomba.*' => 'required|mimes:pdf|max:2048',
                'sertif_organisasi.*' => 'required|mimes:pdf|max:2048',
            ]);

            $pdfPathsLomba = [];
            $pdfPathsOrganisasi = [];
            if ($request->hasFile('sertif_lomba') && $request->hasFile('sertif_organisasi')) {
                foreach ($request->file('sertif_lomba') as $file) {
                    $path = $file->store('sertif_prestasi');
                    $pdfPathsLomba[] = $path;
                }
                foreach ($request->file('sertif_organisasi') as $file) {
                    $path = $file->store('sertif_organisasi');
                    $pdfPathsOrganisasi[] = $path;
                }
                foreach (array_map(null, $pdfPathsLomba, $pdfPathsOrganisasi) as [$sertifLomba, $sertifOrganisasi]){
                    
                    $data = [
                        'da_nim'=>$request->nim,
                        'da_nama'=>$request->nama,
                        'da_prodi'=>$request->prodi,
                        'da_ipk'=>$request->ipk,
                        'da_lab'=>$request->lab,
                        // 'da_sertif_prestasi'=>json_encode($filenames),
                        'da_sertif_prestasi'=>$sertifLomba,
                        'da_sertif_organisasi'=>$sertifOrganisasi,
                        'da_nilai_matkulx'=>$request->nilai_matkulx,
                        'da_nilai_matkuly'=>$request->nilai_matkuly,
                        'da_nilai_matkulz'=>$request->nilai_matkulz,
                        'ide_project'=>$request->ide
                    ];
                data_alternatif::create($data);
                    
                }
                return redirect()->route('dashmhs')->with('success', 'Data Berhasil Ditambahkan!');
            }
        }
    }

    
}
