<?php

namespace App\Http\Controllers;
use App\Models\alternatif;
use App\Models\data_alternatif;
use App\Models\data_lab_ai;
use App\Models\Lab;
use App\Models\nilai_akhir;
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
        $jumlahbaris = 4;
        return view('mahasiswa.formlab', 
        ['nim' => $nim]
    );
        
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
            return view('mahasiswa.formlab_pc', [
                'nim'=>$nim,
                'nama'=>$nama,
                'prodi'=>$prodi,
                'ipk' => $ipk,
                'lab'=>$lab
            ]);
        }elseif($lab == 'Laboratorium Infrastruktur Teknologi'){
            return view('mahasiswa.formlab_it', [
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
                'khs' => 'required|mimes:pdf|max:2048',
            ]);

            $pdfPathsLomba = [];
            if ($request->hasFile('sertif_lomba')) {
                foreach ($request->file('sertif_lomba') as $file) {
                    $path = $file->store('sertif_prestasi');
                    $pdfPathsLomba[] = $path;
                }
            }

            if ($request->hasFile('khs')) {
                    $path = $request->file('khs')->store('khs');
                    $pdfPathsKHS = $path;
                
            }

            $maxCount = max(count($pdfPathsLomba), count($request->ide), count($request->organisasi));
            $existingRecord = data_alternatif::where('da_nama', $request->nama)->where('da_lab', $request->lab)->first();
            if(!$existingRecord){
                for ($index = 0; $index < $maxCount; $index++) {

                    $sertifLomba = $pdfPathsLomba[$index] ?? null;
                    // $sertifOrganisasi = $pdfPathsOrganisasi[$index] ?? null;
                    $ide = $request->ide[$index] ?? null;
                    $organisasi= $request->organisasi[$index] ?? null;
                    $status_organisasi = $request->status_organisasi[$index] ?? null;
                    $status_prestasi = $request->status_prestasi[$index] ?? null;
                        
                        $data = [
                            'da_nim'=>$request->nim,
                            'da_nama'=>$request->nama,
                            'da_prodi'=>$request->prodi,
                            'da_ipk'=>$request->ipk,
                            'da_lab'=>$request->lab,
                            // 'da_sertif_prestasi'=>json_encode($filenames),
                            'da_sertif_prestasi'=>$sertifLomba,
                            'status_pres'=>$status_prestasi,
                            'da_organisasi'=>$organisasi,
                            'status_org'=>$status_organisasi,
                            'khs'=>$pdfPathsKHS,
                            'nilai_keckom'=>$request->nilai_keckom,
                            'nilai_kb'=>$request->nilai_kb,
                            'nilai_pkb'=>$request->nilai_pkb,
                            'nilai_datmin'=>$request->nilai_datmin,
                            'ide_project'=>$ide
                        ];
                    data_alternatif::create($data);
                    
                }
                    return redirect()->route('dashmhs')->with('success', 'Data Berhasil Ditambahkan!');
            }elseif($existingRecord){
                return 'data sudah ada';
            }
            
                
        }elseif($request->lab == 'Laboratorium Pertanian Cerdas'){
            $request->validate([
                'sertif_lomba.*' => 'required|mimes:pdf|max:2048',
            ]);

            $pdfPathsLomba = [];

            // Collect paths for sertif_lomba
            if ($request->hasFile('sertif_lomba')) {
                foreach ($request->file('sertif_lomba') as $file) {
                    $path = $file->store('sertif_prestasi');
                    $pdfPathsLomba[] = $path;
                }
            }
            if ($request->hasFile('khs')) {
                $path = $request->file('khs')->store('khs');
                $pdfPathsKHS = $path;
            }
                // Ensure we don't go out of bounds for the arrays
                $maxCount = max(count($pdfPathsLomba), count($request->link_project));
                $existingRecord = data_alternatif::where('da_nama', $request->nama)->where('da_lab', $request->lab)->first();
                if(!$existingRecord){
                    for ($index = 0; $index < $maxCount; $index++) {
                        $sertifLomba = $pdfPathsLomba[$index] ?? null;
                        $link_project = $request->link_project[$index] ?? null;
                        //kolom bisa berubah sesuai kriteria lab
                        $data = [
                            'da_nim'=>$request->nim,
                            'da_nama'=>$request->nama,
                            'da_prodi'=>$request->prodi,
                            'da_ipk'=>$request->ipk,
                            'da_lab'=>$request->lab,
                            'khs'=>$pdfPathsKHS,
                            'da_sertif_prestasi'=>$sertifLomba,
                            'pc_link_project'=>$link_project,
                            'pc_ppla'=>$request->nilai_matkul_ppla,
                            'pc_sd'=>$request->nilai_matkul_sd,
                            'pc_paa'=>$request->nilai_matkul_paa,
                            'pc_tanggung_jawab'=>$request->tanggung_jawab,
                        ];
                    data_alternatif::create($data);
                    }
                    return view('mahasiswa.berhasil');
                    return redirect()->route('dashmhs')->with('success', 'Data Berhasil Ditambahkan!');    
                }else{
                    return 'data sudah ada';
                }
            }elseif($request->lab == 'Laboratorium Infrastruktur Teknologi'){
                if ($request->hasFile('khs')) {
                    $path = $request->file('khs')->store('khs');
                    $pdfPathsKHS = $path;
                }
                if ($request->has('organisasi') && is_array($request->organisasi)) {
                    // Get the count of the 'organisasi' array
                    $organisasiCount = count($request->organisasi);
                }
                $existingRecord = data_alternatif::where('da_nama', $request->nama)->where('da_lab', $request->lab)->first();
                if(!$existingRecord){
                    for ($index = 0; $index < $organisasiCount; $index++) {
                        $organisasi = $request->organisasi[$index] ?? null;
                        $data = [
                            'da_nim'=>$request->nim,
                            'da_nama'=>$request->nama,
                            'da_prodi'=>$request->prodi,
                            'da_ipk'=>$request->ipk,
                            'da_lab'=>$request->lab,
                            'da_organisasi'=>$organisasi,
                            'khs'=>$pdfPathsKHS,
                            'itnilai_sop'=>$request->nilai_sop,
                            'itnilai_jarkom'=>$request->nilai_jarkom,
                            'itnilai_dmj'=>$request->nilai_dmj,
                            'itnilai_rns'=>$request->nilai_rns,
                        ];
                    data_alternatif::create($data);
                    }
                return view('mahasiswa.linktest_it');
                }else{
                    return 'data sudah ada';
                }

            }
            
        }

        public function search(Request $request){
            $query = nilai_akhir::query();
            if ($request->filled('year')) {
                $year = $request->year;
                $query->whereRaw('YEAR(date) = ?', [$year]);
            }
    
            if ($request->filled('lab')) {
                $query->where('lab', $request->lab);
            }
                
            //GIMANA CARANY BIAR YG MUNCUL ITU UDAH URUT SESUAI NILAI $HASIL
            $total = nilai_akhir::where('lab', $request->lab)
            ->orderBy('total', 'desc')
            ->get();
    
            $tahun = nilai_akhir::selectRaw('YEAR(date) as year')->distinct()->pluck('year');
            $distinct_nama_lab = lab::distinct('nama_lab')->pluck('nama_lab');
            return view('mahasiswa.show_search', [
                'tahun'=>$tahun,
                'total' => $total,
                'distinct_nama_lab'=>$distinct_nama_lab
            ]);
            // return view('dashmhs', [
            //     'results'=> $results
            // ]);
        }

        public function show_search(Request $request){
        }

    

    
}
