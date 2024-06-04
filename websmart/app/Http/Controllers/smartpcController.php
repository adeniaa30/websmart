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

class smartpcController extends Controller
{
    public function smart(){
        $jumlahbaris = 10;
        $totalSum = kriteria::where('lab', 'Laboratorium Pertanian Cerdas')->sum('bobot');
        $kriterias = kriteria::where('lab', 'Laboratorium Pertanian Cerdas')->get();
        foreach ($kriterias as $kriteria) {
            $normBobot = $kriteria->bobot;
            $normKriteria = $kriteria->kriteria;
            $normalisasi = $kriteria->bobot / $totalSum;
            $lab = kriteria::where('kriteria', $normKriteria)->value('lab');
            $existingRecord = normalisasi::where('norm_kriteria', $normKriteria)->first();
            if (!$existingRecord) {
                $isi = [
                    'norm_kriteria' => $normKriteria,
                    'norm_bobot' => $normBobot,
                    'normalisasi' => $normalisasi,
                    'lab' => $lab
                ];
                Normalisasi::create($isi);
            } else {
            }
        }
        $this->pc_insertnilai();
        $this->pc_utilitas();
        $this->pc_nilai_akhir();
        $na = nilai_akhir::where('lab', 'Laboratorium Pertanian Cerdas')->paginate($jumlahbaris);
        $data = normalisasi::where('lab', 'Laboratorium Pertanian Cerdas')->paginate($jumlahbaris);
        $nilai_alt = nilai_alternatif::where('lab', 'Laboratorium Pertanian Cerdas')->paginate($jumlahbaris);
        $uti = utilitas::where('lab', 'Laboratorium Pertanian Cerdas')->paginate($jumlahbaris);



        $final = 0;
        $rank = [];
        $result = [];
        $hasil = [];
        $nilai = nilai_akhir::all(); // Fetch all rows from the table
        $total = nilai_akhir::where('lab', 'Laboratorium Pertanian Cerdas')
            ->orderBy('total', 'desc')
            ->get();

        // $i = $nilai->firstItem();

        // foreach ($nilai as $index => $item) {
        //     $final = $item->na_sertif_prestasi + $item->na_tulis + $item->na_wawancara + $item->napc_ppl + $item->napc_sd + $item->napc_paa + $item->napc_tanggung_jawab + $item->napc_project;
        //     // $i+=1;
        //     $result[$index] = $final;
        // }


        // $prevValue = null;
        // $prevRank = 0;
        // foreach ($result as $index => $value) {
        //     if ($value !== $prevValue) {
        //         $prevRank++;
        //     }
        //     $rank[$index] = $prevRank;
        //     $prevValue = $value;
        // }

        // foreach ($result as $index => $value) {
        //     $hasil[] = "Index: $index, Result: $value, Rank: " . $rank[$index];
        // }

        // $totalSum now contains the sum of values from the specified columns in all rows
            // Define the lab value
        

        $cmin = nilai_alternatif::where('lab', 'Laboratorium Pertanian Cerdas')
        ->selectRaw('MIN(nilai_sertif_prestasi) as min_sp')
        // ->selectRaw('MIN(nilai_sertif_organisasi) as min_so')
        ->selectRaw('MIN(nilai_tulis) as min_tulis')
        ->selectRaw('MIN(nilai_wawancara) as min_wawancara')
        ->selectRaw('MIN(nilaipc_ppla) as min_ppla')
        ->selectRaw('MIN(nilaipc_sd) as min_sd')
        ->selectRaw('MIN(nilaipc_paa) as min_paa')
        ->selectRaw('MIN(nilaipc_project) as min_project')
        ->selectRaw('MIN(nilaipc_tanggungjawab) as min_tanggungjawab')
        ->first();
        $cmax = nilai_alternatif::where('lab', 'Laboratorium Pertanian Cerdas')
        ->selectRaw('MAX(nilai_sertif_prestasi) as max_sp')
        // ->selectRaw('MAX(nilai_sertif_organisasi) as max_so')
        ->selectRaw('MAX(nilai_tulis) as max_tulis')
        ->selectRaw('MAX(nilai_wawancara) as max_wawancara')
        ->selectRaw('MAX(nilaipc_ppla) as max_ppla')
        ->selectRaw('MAX(nilaipc_sd) as max_sd')
        ->selectRaw('MAX(nilaipc_paa) as max_paa')
        ->selectRaw('MAX(nilaipc_project) as max_project')
        ->selectRaw('MAX(nilaipc_tanggungjawab) as max_tanggungjawab')
        ->first();

        return view('admin.spk_pc', [
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

    public function pc_insertnilai(){
        $data = data_alternatif::where('da_lab', 'Laboratorium Pertanian Cerdas')->get();
        $da_lab = data_alternatif::where('da_lab', 'Laboratorium Pertanian Cerdas')->value('da_lab');
        // $da_kom = data_alternatif::where('da_lab', 'Laboratorium Pertanian Cerdas')->value('ai_komunikasi_kerja');
        // $da_ide = data_alternatif::where('da_lab', 'Laboratorium Pertanian Cerdas')->value('ide_project');
        
        $processedNames = [];
        $result = [];
        foreach($data as $item){
            $nama = $item->da_nama;
            $jmlData = data_alternatif::where('da_nama', $nama)->get();
            $jmlBaris = count($jmlData);
            if (in_array($nama, $processedNames)) {
                continue;
            }
            $processedNames[] = $nama;
            $sertiflomba = $item->da_sertif_prestasi;
            $nilai_lomba = $this->pc_cek_sertiflomba($sertiflomba,$jmlBaris);
            $nilai_tulis = $item->da_nilai_tulis;
            $nilai_wawancara = $item->da_nilai_wawancara;
            $ppla = $item->pc_ppla;
            $nilai_ppla = $this->pc_cek_ppla($ppla);
            $sd = $item->pc_sd;
            $nilai_sd = $this->pc_cek_sd($sd);
            $paa = $item->pc_paa;
            $nilai_paa = $this->pc_cek_paa($paa);
            $lab = $da_lab;
            $tanggungjawab = $item->pc_tanggung_jawab;
            $nilai_tj = $this->pc_cek_tj($tanggungjawab);
            $project = $item->pc_link_project;
            $nilai_project = $this->pc_cek_project($project,$jmlBaris);

            $existingRecord = nilai_alternatif::where('nama',$nama)->where('lab', $lab)->first();
            $data = [
                'nama'=>$nama,
                'nilai_sertif_prestasi'=>$nilai_lomba,
                // 'nilai_sertif_organisasi'=>
                'nilai_tulis'=>$nilai_tulis,
                'nilai_wawancara'=>$nilai_wawancara,
                'nilaipc_tanggungjawab'=>$nilai_tj,
                'nilaipc_project'=>$nilai_project,
                'nilaipc_ppla'=>$nilai_ppla,
                'nilaipc_sd'=>$nilai_sd,
                'nilaipc_paa'=>$nilai_paa,
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

    public function pc_cek_sertiflomba($sertiflomba,$jmlBaris){
        if ($sertiflomba == null ) {
            $hasil= subkriteria::where('kriteria', 'Partisipasi Lomba (PC)')
                                    ->where('subkriteria', '<=1')->value('nilai');
        }elseif($sertiflomba !== null && $jmlBaris==1){
            $hasil= subkriteria::where('kriteria', 'Partisipasi Lomba (PC)')
                                    ->where('subkriteria', '<=1')->value('nilai');
        } elseif($sertiflomba !== null && $jmlBaris>1){
            $hasil= subkriteria::where('kriteria', 'Partisipasi Lomba (PC)')
                                    ->where('subkriteria', '>1')->value('nilai');
        }
    
    return $hasil; 
    }

    public function pc_cek_ppla($ppla){
        if($ppla == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (PC)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }
        if($ppla == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (PC)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }

    public function pc_cek_sd($sd){
        if($sd == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (PC)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }
        if($sd == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (PC)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
        }
    }

    public function pc_cek_paa($paa){
        if($paa == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (PC)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }
        if($paa == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (PC)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }

    public function pc_cek_tj($tanggungjawab){
        if ($tanggungjawab == 'Ya'){
            $hasil = subkriteria::where('kriteria', 'Tanggung Jawab (PC)')
                                ->where('subkriteria', 'sangat baik')->value('nilai');
            return $hasil;
        }elseif($tanggungjawab == 'Mungkin'){
            $hasil = subkriteria::where('kriteria', 'Tanggung Jawab (PC)')
                                ->where('subkriteria', 'baik')->value('nilai');
            return $hasil;
        }elseif($tanggungjawab == 'Tidak'){
            $hasil = subkriteria::where('kriteria', 'Tanggung Jawab (PC)')
                                ->where('subkriteria', 'cukup')->value('nilai');
            return $hasil;
        }
    }

    public function pc_cek_project($project,$jmlBaris){
        if($project == null){
            $hasil = subkriteria::where('kriteria', 'Portofolio Project (PC)')
                                ->where('subkriteria', '<1')->value('nilai');
        }elseif($project !== null && $jmlBaris>=1){
            $hasil = subkriteria::where('kriteria', 'Portofolio Project (PC)')
                                ->where('subkriteria', '>=1')->value('nilai');
        }
    return $hasil;
    }

    public function pc_utilitas(){
        $baris = nilai_alternatif::where('lab', 'Laboratorium Pertanian Cerdas')->get();
        foreach($baris as $item){
            $nama = $item->nama;
            $nilai_sp = $item->nilai_sertif_prestasi;
            $nilai_tulis = $item->nilai_tulis;
            $nilai_wawancara = $item->nilai_wawancara;
            $nilai_ppla = $item->nilaipc_ppla;
            $nilai_sd = $item->nilaipc_sd;
            $nilai_paa = $item->nilaipc_paa;
            $nilai_project = $item->nilaipc_project;
            $nilai_tanggungjawab = $item->nilaipc_tanggungjawab;
            $lab = $item->lab;
            $this->pc_rumus_uti($nama, $nilai_sp, $nilai_tulis, $nilai_wawancara, $nilai_ppla, $nilai_sd, $nilai_paa, $nilai_project, $nilai_tanggungjawab,$lab);
        }
        return 'isert data berhasil';
    }

    public function pc_rumus_uti($nama, $nilai_sp, $nilai_tulis, $nilai_wawancara, $nilai_ppla, $nilai_sd, $nilai_paa, $nilai_project, $nilai_tanggungjawab,$lab){
        $minMaxValues = nilai_alternatif::select(
            DB::raw('MIN(nilai_sertif_prestasi) as min_sp'),
            DB::raw('MAX(nilai_sertif_prestasi) as max_sp'),
            DB::raw('MIN(nilai_tulis) as min_tulis'),
            DB::raw('MAX(nilai_tulis) as max_tulis'),
            DB::raw('MIN(nilai_wawancara) as min_wawancara'),
            DB::raw('MAX(nilai_wawancara) as max_wawancara'),
            DB::raw('MIN(nilaipc_ppla) as min_ppla'),
            DB::raw('MAX(nilaipc_ppla) as max_ppla'),
            DB::raw('MIN(nilaipc_sd) as min_sd'),
            DB::raw('MAX(nilaipc_sd) as max_sd'),
            DB::raw('MIN(nilaipc_paa) as min_paa'),
            DB::raw('MAX(nilaipc_paa) as max_paa'),
            DB::raw('MIN(nilaipc_project) as min_project'),
            DB::raw('MAX(nilaipc_project) as max_project'),
            DB::raw('MIN(nilaipc_tanggungjawab) as min_tanggungjawab'),
            DB::raw('MAX(nilaipc_tanggungjawab) as max_tanggungjawab'),
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
            $min_wawancara = $minMaxValues->min_wawancara;
            $max_wawancara = $minMaxValues->max_wawancara;
            $min_ppla = $minMaxValues->min_ppla;
            $max_ppla = $minMaxValues->max_ppla;
            $min_sd = $minMaxValues->min_sd;
            $max_sd = $minMaxValues->max_sd;
            $min_paa = $minMaxValues->min_paa;
            $max_paa = $minMaxValues->max_paa;
            $min_project = $minMaxValues->min_project;
            $max_project = $minMaxValues->max_project;
            $min_tanggungjawab = $minMaxValues->min_tanggungjawab;
            $max_tanggungjawab = $minMaxValues->max_tanggungjawab;
            // Extract min and max values for other columns similarly

            $uti_sp = ($max_sp != $min_sp) ? ($nilai_sp - $min_sp) / ($max_sp - $min_sp) : 0;
            $uti_tulis = ($max_tulis != $min_tulis) ? ($nilai_tulis - $min_tulis) / ($max_tulis - $min_tulis) : 0;
            $uti_wawancara = ($max_wawancara != $min_wawancara) ? ($nilai_wawancara - $min_wawancara) / ($max_wawancara - $min_wawancara) : 0;
            $uti_ppla = ($max_ppla != $min_ppla) ? ($nilai_ppla - $min_ppla) / ($max_ppla - $min_ppla) : 0;
            $uti_sd = ($max_sd != $min_sd) ? ($nilai_sd - $min_sd) / ($max_sd - $min_sd) : 0;
            $uti_project = ($max_project != $min_project) ? ($nilai_project - $min_project) / ($max_project - $min_project) : 0;
            $uti_paa = ($max_paa != $min_paa) ? ($nilai_paa - $min_paa) / ($max_paa - $min_paa) : 0;
            $uti_tanggungjawab = ($max_tanggungjawab != $min_tanggungjawab) ? ($nilai_tanggungjawab - $min_tanggungjawab) / ($max_tanggungjawab - $min_tanggungjawab) : 0;

            // Calculate the normalized values for other columns similarly
            $existingRecord = utilitas::where('nama', $nama)->first();
            $data = [
                'nama'=>$nama,
                'uti_sertif_prestasi'=>$uti_sp,
                'uti_tulis'=>$uti_tulis,
                'uti_wawancara'=>$uti_wawancara,
                'utipc_ppla'=>$uti_ppla,
                'utipc_sd'=>$uti_sd,
                'utipc_paa'=>$uti_paa,
                'utipc_project'=>$uti_project,
                'utipc_tanggung_jawab'=>$uti_tanggungjawab,
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

    public function pc_nilai_akhir(){
        $norm_sp = normalisasi::where('norm_kriteria', 'Partisipasi Lomba (PC)')
                            ->where('lab', 'Laboratorium Pertanian Cerdas')->value('normalisasi');
        $norm_wawancara = normalisasi::where('norm_kriteria', 'Tes Wawancara (PC)')
                                        ->where('lab', 'Laboratorium Pertanian Cerdas')->value('normalisasi');
        $norm_matkul = normalisasi::where('norm_kriteria', 'Nilai Mata Kuliah (PC)')
                                    ->where('lab', 'Laboratorium Pertanian Cerdas')->value('normalisasi');
        $norm_project = normalisasi::where('norm_kriteria', 'Portofolio Project (PC)')
                                    ->where('lab', 'Laboratorium Pertanian Cerdas')->value('normalisasi');
        $norm_tulis = normalisasi::where('norm_kriteria', 'Tes Tulis (PC)')
                                    ->where('lab', 'Laboratorium Pertanian Cerdas')->value('normalisasi');
        $norm_tanggungjawab = normalisasi::where('norm_kriteria', 'Tanggung Jawab (PC)')
                                    ->where('lab', 'Laboratorium Pertanian Cerdas')->value('normalisasi');



        $data = utilitas::where('lab', 'Laboratorium Pertanian Cerdas')->get();
        // $jmlbaris2 = count($baris2);
        // $data2 = utilitas::paginate($jmlbaris2);

        // $j = $data->firstItem();

        foreach($data as $item2){
            $nama = $item2->nama;
            $sp = $item2->uti_sertif_prestasi;
            $na_sp = $sp * $norm_sp;
            $wawancara = $item2->uti_wawancara;
            $na_wawancara = $wawancara * $norm_wawancara;
            $tulis = $item2->uti_tulis;
            $na_tulis = $tulis * $norm_tulis;
            $ppla = $item2->utipc_ppla;
            $na_ppla = $ppla * $norm_matkul;
            $sd = $item2->utipc_sd;
            $na_sd = $sd * $norm_matkul;
            $paa = $item2->utipc_paa;
            $na_paa = $paa * $norm_matkul;
            $project = $item2->utipc_project;
            $na_project = $project * $norm_project;
            $tanggungjawab = $item2->utipc_tanggung_jawab;
            $na_tanggungjawab = $tanggungjawab * $norm_tanggungjawab;
            $lab = $item2->lab;
            $total = $na_sp+$na_wawancara+$na_tulis+$na_ppla+$na_sd+$na_paa+$na_project+$na_tanggungjawab;

            
            $existingRecord = nilai_akhir::where('nama', $nama)->first();
            $data = [
                'nama'=>$nama,
                'na_sertif_prestasi'=>$na_sp,
                // 'na_sertif_organisasi'=>$na_so,
                'na_tulis'=>$na_tulis,
                'na_wawancara'=>$na_wawancara,
                'napc_ppla'=>$na_ppla,
                'napc_sd'=>$na_sd,
                'napc_paa'=>$na_paa,
                'napc_project'=>$na_project,
                'napc_tanggung_jawab'=>$na_tanggungjawab,
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

    public function testpc(){
        $total = nilai_akhir::where('lab', 'Laboratorium Artificial Intelligence')
        ->orderBy('total')->get();
        return $total;

    }

}
