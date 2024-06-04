<?php

namespace App\Http\Controllers;

use App\Models\data_alternatif;
use App\Models\kriteria;
use App\Models\nilai_akhir;
use App\Models\nilai_alternatif;
use App\Models\normalisasi;
use App\Models\subkriteria;
use App\Models\utilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class smartITController extends Controller
{
    public function smart(){
        $jumlahbaris = 10;
        $totalSum = kriteria::where('lab', 'Laboratorium Infrastruktur Teknologi')->sum('bobot');
        $kriterias = kriteria::where('lab', 'Laboratorium Infrastruktur Teknologi')->get();

        foreach ($kriterias as $kriteria) {
            $normBobot = $kriteria->bobot;
            $normKriteria = $kriteria->kriteria;
            $normalisasi = $kriteria->bobot / $totalSum;
            $lab = kriteria::where('kriteria', $normKriteria)->value('lab');
            $existingRecord = normalisasi::where('norm_kriteria', $normKriteria)->first();

            if (!$existingRecord) {
                // If no existing record found, proceed with insertion
                $isi = [
                    'norm_kriteria' => $normKriteria,
                    'norm_bobot' => $normBobot,
                    'normalisasi' => $normalisasi,
                    'lab' => $lab
                ];
                Normalisasi::create($isi);
            } else {
                // Handle duplication: Skip insertion, log, or perform other actions
                // For example, you can log the duplication or skip the insertion
                // Log::info('Duplicate record found for norm_kriteria: ' . $normKriteria);
            }
        }
        $this->it_insertnilai();
        $this->it_utilitas();
        $this->it_nilai_akhir();
        $na = nilai_akhir::where('lab', 'Laboratorium Infrastruktur Teknologi')->paginate($jumlahbaris);
        $data = normalisasi::where('lab', 'Laboratorium Infrastruktur Teknologi')->paginate($jumlahbaris);
        $nilai_alt = nilai_alternatif::where('lab', 'Laboratorium Infrastruktur Teknologi')->paginate($jumlahbaris);
        $uti = utilitas::where('lab', 'Laboratorium Infrastruktur Teknologi')->paginate($jumlahbaris);



        $final = 0;
        $rank = [];
        $result = [];
        $hasil = [];
        $nilai = nilai_akhir::all(); // Fetch all rows from the table
        $total = nilai_akhir::where('lab', 'Laboratorium Infrastruktur Teknologi')
            ->orderBy('total', 'desc')
            ->get();

        $cmin = nilai_alternatif::where('lab', 'Laboratorium Infrastruktur Teknologi')
        ->selectRaw('MIN(nilai_sertif_prestasi) as min_sp')
        ->selectRaw('MIN(nilai_tulis) as min_tulis')
        ->selectRaw('MIN(itnilai_sop) as min_sop')
        ->selectRaw('MIN(itnilai_jarkom) as min_jarkom')
        ->selectRaw('MIN(itnilai_dmj) as min_dmj')
        ->selectRaw('MIN(itnilai_rns) as min_rns')
        ->selectRaw('MIN(itnilai_mengajar) as min_mengajar')
        ->selectRaw('MIN(itnilai_probsolv) as min_probsolv')
        ->selectRaw('MIN(itnilai_timemj) as min_timemj')
        ->first();
        $cmax = nilai_alternatif::where('lab', 'Laboratorium Infrastruktur Teknologi')
        ->selectRaw('MAX(nilai_sertif_prestasi) as max_sp')
        ->selectRaw('MAX(nilai_tulis) as max_tulis')
        ->selectRaw('MAX(itnilai_sop) as max_sop')
        ->selectRaw('MAX(itnilai_jarkom) as max_jarkom')
        ->selectRaw('MAX(itnilai_dmj) as max_dmj')
        ->selectRaw('MAX(itnilai_rns) as max_rns')
        ->selectRaw('MAX(itnilai_mengajar) as max_mengajar')
        ->selectRaw('MAX(itnilai_probsolv) as max_probsolv')
        ->selectRaw('MAX(itnilai_timemj) as max_timemj')
        ->first();

        return view('admin.spk_it', [
            'data' => $data,
            'totalSum' => $totalSum,
            'nilai_alt'=> $nilai_alt,
            'cmin'=> $cmin,
            'cmax'=> $cmax,
            'uti' => $uti,
            'na' => $na,
            'total' => $total,
            'rank' => $rank,
        ]);
    }

    public function it_insertnilai(){
        $data = data_alternatif::where('da_lab', 'Laboratorium Infrastruktur Teknologi')->get();
        $da_lab = data_alternatif::where('da_lab', 'Laboratorium Infrastruktur Teknologi')->value('da_lab');
        // $da_kom = data_alternatif::where('da_lab', 'Laboratorium Pertanian Cerdas')->value('ai_komunikasi_kerja');
        // $da_ide = data_alternatif::where('da_lab', 'Laboratorium Pertanian Cerdas')->value('ide_project');
        
        $processedNames = [];
        $result = [];
        foreach($data as $item){
            $nama = $item->da_nama;
            $jmlData = data_alternatif::where('da_nama', $nama)->where('da_lab', $item->da_lab)->get();
            $jmlBaris = count($jmlData);
            if (in_array($nama, $processedNames)) {
                continue;
            }
            $processedNames[] = $nama;
            $pengalaman = $item->da_organisasi;
            $nilai_pengalaman = $this->it_cek_pengalaman($pengalaman,$jmlBaris);
            $nilai_tulis = $item->da_nilai_tulis;
            $sop = $item->itnilai_sop;
            $nilai_sop = $this->it_cek_sop($sop);
            $jarkom = $item->itnilai_jarkom;
            $nilai_jarkom = $this->it_cek_jarkom($jarkom);
            $dmj = $item->itnilai_dmj;
            $nilai_dmj = $this->it_cek_dmj($dmj);
            $rns = $item->itnilai_rns;
            $nilai_rns = $this->it_cek_rns($rns);
            $mengajar = $item->itnilai_mengajar;
            $nilai_mengajar = $this->it_cek_mengajar($mengajar);
            $probsolv = $item->itnilai_probsolv;
            $nilai_probsolv = $this->it_cek_probsolv($probsolv);
            $timemj = $item->itnilai_timemj;
            $nilai_timemj = $this->it_cek_timemj($timemj);
            $lab = $da_lab;

            $existingRecord = nilai_alternatif::where('nama',$nama)->where('lab', $lab)->first();
            $data = [
                'nama'=>$nama,
                'nilai_sertif_prestasi'=>$nilai_pengalaman,
                'nilai_tulis'=>$nilai_tulis,
                'itnilai_sop'=>$nilai_sop,
                'itnilai_jarkom'=>$nilai_jarkom,
                'itnilai_dmj'=>$nilai_dmj,
                'itnilai_rns'=>$nilai_rns,
                'itnilai_mengajar'=>$nilai_mengajar,
                'itnilai_probsolv'=>$nilai_probsolv,
                'itnilai_timemj'=>$nilai_timemj,
                'lab'=>$lab,
            ];

            if(!$existingRecord){
                nilai_alternatif::create($data);
                // return 'insert data berhasil';
            }elseif($existingRecord){
                $existingRecord->update($data);
            }
        }
    }

    public function it_cek_pengalaman($pengalaman,$jmlBaris){
        if ($pengalaman == null ) {
            $hasil= subkriteria::where('kriteria', 'Pengalaman (IT)')
                                    ->where('subkriteria', '<=2')->value('nilai');
            return $hasil; 
        }elseif($pengalaman !== null && $jmlBaris<=2){
            $hasil= subkriteria::where('kriteria', 'Pengalaman (IT)')
                                    ->where('subkriteria', '<=2')->value('nilai');
            return $hasil; 
        } elseif($pengalaman !== null && $jmlBaris>=3 && $jmlBaris<=5 ){
            $hasil= subkriteria::where('kriteria', 'Pengalaman (IT)')
                                    ->where('subkriteria', '3-5')->value('nilai');
            return $hasil; 
        }elseif($pengalaman !== null && $jmlBaris>=3 && $jmlBaris<=5){
            $hasil= subkriteria::where('kriteria', 'Pengalaman (IT)')
                                    ->where('subkriteria', '>5')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    
    }

    public function it_cek_sop($sop){
        if($sop == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }
        if($sop == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }

    public function it_cek_jarkom($jarkom){
        if($jarkom == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }
        if($jarkom == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
        }
    }

    public function it_cek_dmj($dmj){
        if($dmj == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }
        if($dmj == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }

    public function it_cek_rns($rns){
        if ($rns == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }elseif($rns == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (IT)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }

    public function it_cek_mengajar($mengajar){
        if($mengajar == 'Baik'){
            $hasil = subkriteria::where('kriteria', 'Presentasi Mengajar (IT)')
                                ->where('subkriteria', 'Baik')->value('nilai');
            return $hasil; 
        }elseif($mengajar == 'Cukup Baik'){
            $hasil = subkriteria::where('kriteria', 'Presentasi Mengajar (IT)')
                                ->where('subkriteria', 'Cukup Baik')->value('nilai');
            return $hasil; 
        }
    }

    public function it_cek_probsolv($probsolv){
        if($probsolv == 'Baik'){
            $hasil = subkriteria::where('kriteria', 'Problem Solving (IT)')
                                ->where('subkriteria', 'Baik')->value('nilai');
            return $hasil; 
        }elseif($probsolv == 'Cukup Baik'){
            $hasil = subkriteria::where('kriteria', 'Problem Solving (IT)')
                                ->where('subkriteria', 'Cukup Baik')->value('nilai');
            return $hasil; 
        }
    }

    public function it_cek_timemj($timemj){
        if($timemj == 'Baik'){
            $hasil = subkriteria::where('kriteria', 'Time Management (IT)')
                                ->where('subkriteria', 'Baik')->value('nilai');
            return $hasil; 
        }elseif($timemj == 'Cukup Baik'){
            $hasil = subkriteria::where('kriteria', 'Time Management (IT)')
                                ->where('subkriteria', 'Cukup Baik')->value('nilai');
            return $hasil; 
        }
    }

    public function it_utilitas(){
        $baris = nilai_alternatif::where('lab', 'Laboratorium Infrastruktur Teknologi')->get();
        foreach($baris as $item){
            $nama = $item->nama;
            $nilai_tulis = $item->nilai_tulis;
            $itnilai_pengalaman = $item->nilai_sertif_prestasi;
            $itnilai_sop = $item->itnilai_sop;
            $itnilai_jarkom = $item->itnilai_jarkom;
            $itnilai_dmj = $item->itnilai_dmj;
            $itnilai_rns = $item->itnilai_rns;
            $itnilai_mengajar = $item->itnilai_mengajar;
            $itnilai_probsolv = $item->itnilai_probsolv;
            $itnilai_timemj = $item->itnilai_timemj;
            $lab = $item->lab;
            $this->it_rumus_uti($nama, $itnilai_pengalaman, $nilai_tulis, $itnilai_sop, $itnilai_jarkom, $itnilai_dmj, $itnilai_rns, $itnilai_mengajar, $itnilai_probsolv, $itnilai_timemj,$lab);
        }
        return 'isert data berhasil';
    }

    public function it_rumus_uti($nama, $itnilai_pengalaman, $nilai_tulis, $itnilai_sop, $itnilai_jarkom, $itnilai_dmj, $itnilai_rns, $itnilai_mengajar, $itnilai_probsolv, $itnilai_timemj,$lab){
        $minMaxValues = nilai_alternatif::select(
            DB::raw('MIN(nilai_sertif_prestasi) as min_sp'),
            DB::raw('MAX(nilai_sertif_prestasi) as max_sp'),
            DB::raw('MIN(nilai_tulis) as min_tulis'),
            DB::raw('MAX(nilai_tulis) as max_tulis'),
            DB::raw('MIN(itnilai_sop) as min_sop'),
            DB::raw('MAX(itnilai_sop) as max_sop'),
            DB::raw('MIN(itnilai_jarkom) as min_jarkom'),
            DB::raw('MAX(itnilai_jarkom) as max_jarkom'),
            DB::raw('MIN(itnilai_dmj) as min_dmj'),
            DB::raw('MAX(itnilai_dmj) as max_dmj'),
            DB::raw('MIN(itnilai_rns) as min_rns'),
            DB::raw('MAX(itnilai_rns) as max_rns'),
            DB::raw('MIN(itnilai_mengajar) as min_mengajar'),
            DB::raw('MAX(itnilai_mengajar) as max_mengajar'),
            DB::raw('MIN(itnilai_probsolv) as min_probsolv'),
            DB::raw('MAX(itnilai_probsolv) as max_probsolv'),
            DB::raw('MIN(itnilai_timemj) as min_timemj'),
            DB::raw('MAX(itnilai_timemj) as max_timemj'),
            // Add more columns as needed
        )
        ->where('lab', $lab)
        ->first();

        if ($minMaxValues) {
            // Extract min and max values for each column
            $min_sp = $minMaxValues->min_sp;
            $max_sp = $minMaxValues->max_sp;
            $min_tulis = $minMaxValues->min_tulis;
            $max_tulis = $minMaxValues->max_tulis;
            $min_sop = $minMaxValues->min_sop;
            $max_sop = $minMaxValues->max_sop;
            $min_jarkom = $minMaxValues->min_jarkom;
            $max_jarkom = $minMaxValues->max_jarkom;
            $min_dmj = $minMaxValues->min_dmj;
            $max_dmj = $minMaxValues->max_dmj;
            $min_rns = $minMaxValues->min_rns;
            $max_rns = $minMaxValues->max_rns;
            $min_mengajar = $minMaxValues->min_mengajar;
            $max_mengajar = $minMaxValues->max_mengajar;
            $min_probsolv = $minMaxValues->min_probsolv;
            $max_probsolv = $minMaxValues->max_probsolv;
            $min_timemj = $minMaxValues->min_timemj;
            $max_timemj = $minMaxValues->max_timemj;
            // Extract min and max values for other columns similarly

            $uti_sp = ($max_sp != $min_sp) ? ($itnilai_pengalaman - $min_sp) / ($max_sp - $min_sp) : 0;
            $uti_tulis = ($max_tulis != $min_tulis) ? ($nilai_tulis - $min_tulis) / ($max_tulis - $min_tulis) : 0;
            $uti_sop = ($max_sop != $min_sop) ? ($itnilai_sop - $min_sop) / ($max_sop - $min_sop) : 0;
            $uti_jarkom = ($max_jarkom != $min_jarkom) ? ($itnilai_jarkom - $min_jarkom) / ($max_jarkom - $min_jarkom) : 0;
            $uti_dmj = ($max_dmj != $min_dmj) ? ($itnilai_dmj - $min_dmj) / ($max_dmj - $min_dmj) : 0;
            $uti_rns = ($max_rns != $min_rns) ? ($itnilai_rns - $min_rns) / ($max_rns - $min_rns) : 0;
            $uti_mengajar = ($max_mengajar != $min_mengajar) ? ($itnilai_mengajar - $min_mengajar) / ($max_mengajar - $min_mengajar) : 0;
            $uti_probsolv = ($max_probsolv != $min_probsolv) ? ($itnilai_probsolv - $min_probsolv) / ($max_probsolv - $min_probsolv) : 0;
            $uti_timemj = ($max_timemj != $min_timemj) ? ($itnilai_timemj - $min_timemj) / ($max_timemj - $min_timemj) : 0;

            // Calculate the normalized values for other columns similarly
            $existingRecord = utilitas::where('nama', $nama)->where('lab',$lab)->first();
            $data = [
                'nama'=>$nama,
                'uti_sertif_prestasi'=>$uti_sp,
                'uti_tulis'=>$uti_tulis,
                'itnilai_sop'=>$uti_sop,
                'itnilai_jarkom'=>$uti_jarkom,
                'itnilai_dmj'=>$uti_dmj,
                'itnilai_rns'=>$uti_rns,
                'itnilai_mengajar'=>$uti_mengajar,
                'itnilai_probsolv'=>$uti_probsolv,
                'itnilai_timemj'=>$uti_timemj,
                'lab'=>$lab
            ];

            if(!$existingRecord){
                    utilitas::create($data);
            }else{
                $existingRecord->update($data);
            }
        } else {
        }
    }

    public function it_nilai_akhir(){
        $norm_sp = normalisasi::where('norm_kriteria', 'Pengalaman (IT)')
                            ->where('lab', 'Laboratorium Infrastruktur Teknologi')->value('normalisasi');
        $norm_tulis = normalisasi::where('norm_kriteria', 'Kompetensi Mata Kuliah (IT)')
                                        ->where('lab', 'Laboratorium Infrastruktur Teknologi')->value('normalisasi');
        $norm_matkul = normalisasi::where('norm_kriteria', 'Nilai Mata Kuliah (IT)')
                                    ->where('lab', 'Laboratorium Infrastruktur Teknologi')->value('normalisasi');
        $norm_mengajar = normalisasi::where('norm_kriteria', 'Presentasi Mengajar (IT)')
                                    ->where('lab', 'Laboratorium Infrastruktur Teknologi')->value('normalisasi');
        $norm_probsolv = normalisasi::where('norm_kriteria', 'Problem Solving (IT)')
                                    ->where('lab', 'Laboratorium Infrastruktur Teknologi')->value('normalisasi');
        $norm_timemj = normalisasi::where('norm_kriteria', 'Time Management (IT)')
                                    ->where('lab', 'Laboratorium Infrastruktur Teknologi')->value('normalisasi');



        $data = utilitas::where('lab', 'Laboratorium Infrastruktur Teknologi')->get();
        // $jmlbaris2 = count($baris2);
        // $data2 = utilitas::paginate($jmlbaris2);

        // $j = $data->firstItem();

        foreach($data as $item2){
            $nama = $item2->nama;
            $sp = $item2->uti_sertif_prestasi;
            $na_sp = $sp * $norm_sp;
            $tulis = $item2->uti_tulis;
            $na_tulis = $tulis * $norm_tulis;
            $sop = $item2->itnilai_sop;
            $na_sop = $sop * $norm_matkul;
            $jarkom = $item2->itnilai_jarkom;
            $na_jarkom = $jarkom * $norm_matkul;
            $dmj = $item2->itnilai_dmj;
            $na_dmj = $dmj * $norm_matkul;
            $rns = $item2->itnilai_rns;
            $na_rns = $rns * $norm_matkul;
            $mengajar = $item2->itnilai_mengajar;
            $na_mengajar = $mengajar * $norm_mengajar;
            $probsolv = $item2->itnilai_probsolv;
            $na_probsolv = $probsolv * $norm_probsolv;
            $timemj = $item2->itnilai_timemj;
            $na_timemj = $timemj * $norm_timemj;
            $lab = $item2->lab;
            $total = $na_sp+$na_tulis+$na_sop+$na_jarkom+$na_dmj+$na_rns+$na_mengajar+$na_probsolv+$na_timemj;

            
            $existingRecord = nilai_akhir::where('nama', $nama)->where('lab', $lab)->first();
            $data = [
                'nama'=>$nama,
                'na_sertif_prestasi'=>$na_sp,
                'na_tulis'=>$na_tulis,
                'itnilai_sop'=>$na_sop,
                'itnilai_jarkom'=>$na_jarkom,
                'itnilai_dmj'=>$na_dmj,
                'itnilai_rns'=>$na_rns,
                'itnilai_mengajar'=>$na_mengajar,
                'itnilai_probsolv'=>$na_probsolv,
                'itnilai_timemj'=>$na_timemj,
                'lab'=>$lab,
                'total'=>$total
            ];
            if(!$existingRecord){
                nilai_akhir::create($data);
            }elseif($existingRecord){
                $existingRecord->update($data);
            }
            
            // $j+=1;
        }
    }

    public function testit(){
    }

}
