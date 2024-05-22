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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class smartController extends Controller
{
    public function smart(Request $request){
        //BIKIN LOG
        
        //user
        if (Auth::check() && Auth::user()->name === 'aslab ai'){
            //NORMALISASI KRITERIA
        $jumlahbaris = 10;
        $totalSum = kriteria::where('lab', 'Laboratorium Artificial Intelligence')->sum('bobot');
        $kriterias = kriteria::where('lab', 'Laboratorium Artificial Intelligence')->get();

        foreach ($kriterias as $kriteria) {
            $normBobot = $kriteria->bobot;
            $normKriteria = $kriteria->kriteria;
            $normalisasi = $kriteria->bobot / $totalSum;
            $lab = kriteria::where('kriteria', $normKriteria)->value('lab');
            $existingRecord = Normalisasi::where('norm_kriteria', $normKriteria)->first();

            $isi = [
                'norm_kriteria' => $normKriteria,
                'norm_bobot' => $normBobot,
                'normalisasi' => $normalisasi,
                'lab' => $lab
            ];

            if (!$existingRecord) {
                // If no existing record found, proceed with insertion
                Normalisasi::create($isi);
            } else {
                $existingRecord->update($isi);
                // Handle duplication: Skip insertion, log, or perform other actions
                // For example, you can log the duplication or skip the insertion
                // Log::info('Duplicate record found for norm_kriteria: ' . $normKriteria);
            }
        }
        $data = normalisasi::where('lab', 'Laboratorium Artificial Intelligence')->paginate($jumlahbaris);
        $this->ai_insertnilai();
        $nilai_alt = nilai_alternatif::where('lab', 'Laboratorium Artificial Intelligence')->paginate($jumlahbaris);
        $this->ai_utilitas();
        $uti = utilitas::where('lab', 'Laboratorium Artificial Intelligence')->paginate($jumlahbaris);
        $this->ai_nilai_akhir();
        $na = nilai_akhir::where('lab', 'Laboratorium Artificial Intelligence')->paginate($jumlahbaris);

        $final = 0;
        $rank = [];
        $result = [];
        $hasil = [];
        $nilai = nilai_akhir::where('lab', 'Laboratorium Artificial Intelligence')->get(); // Fetch all rows from the table
        $total = nilai_akhir::where('lab', 'Laboratorium Artificial Intelligence')
        ->orderBy('total', 'desc')
        ->get();

        // // $i = $nilai->firstItem();

        // foreach ($nilai as $index => $item) {
        //     $final = $item->na_sertif_prestasi + $item->na_wawancara + $item->na_keckom + $item->na_kb + $item->na_pkb + $item->na_datmin + $item->na_kontribusi_ide;
        //     // $i+=1;
        //     $result[$index] = $final;
        // }
        // $total = nilai_akhir::where('lab',  'Laboratorium Artificial Intelligence')->pluck('total');
        // arsort($total);

        // arsort($result); 

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


        $cmin = nilai_alternatif::where('lab', 'Laboratorium Artificial Intelligence')
        ->selectRaw('MIN(nilai_sertif_prestasi) as min_sp')
        ->selectRaw('MIN(nilai_sertif_organisasi) as min_so')
        ->selectRaw('MIN(nilai_tulis) as min_tulis')
        ->selectRaw('MIN(nilai_wawancara) as min_wawancara')
        ->selectRaw('MIN(nilai_keckom) as min_keckom')
        ->selectRaw('MIN(nilai_kb) as min_kb')
        ->selectRaw('MIN(nilai_pkb) as min_pkb')
        ->selectRaw('MIN(nilai_datmin) as min_datmin')
        ->selectRaw('MIN(nilai_kontribusi_ide) as min_ide')
        ->first();
        $cmax = nilai_alternatif::where('lab', 'Laboratorium Artificial Intelligence')
        ->selectRaw('MAX(nilai_sertif_prestasi) as max_sp')
        ->selectRaw('MAX(nilai_sertif_organisasi) as max_so')
        ->selectRaw('MAX(nilai_tulis) as max_tulis')
        ->selectRaw('MAX(nilai_wawancara) as max_wawancara')
        ->selectRaw('MAX(nilai_keckom) as max_keckom')
        ->selectRaw('MAX(nilai_kb) as max_kb')
        ->selectRaw('MAX(nilai_pkb) as max_pkb')
        ->selectRaw('MAX(nilai_datmin) as max_datmin')
        ->selectRaw('MAX(nilai_kontribusi_ide) as max_ide')
        ->first();

        return view('admin.spk', [
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

        // return 'insert berhasil';
        //LANJUTIN PROSES CEK KONTRIBUSI IDE
        

        // $data = normalisasi::paginate($jumlahbaris);
        
        }
    }

    //START FUNCTION KHUSUS UNTUK LAB AI
    
    public function ai_cek_ide($ide,$jmlBaris){
            if($ide == null){
                $hasil = subkriteria::where('kriteria', 'Kontribusi Ide Project')
                                    ->where('subkriteria', '<1')->value('nilai');
            }elseif($ide !== null && $jmlBaris>=1 && $jmlBaris<=2 ){
                $hasil = subkriteria::where('kriteria', 'Kontribusi Ide Project')
                                    ->where('subkriteria', '1-2')->value('nilai');
            }elseif($ide !== null && $jmlBaris>2){
                $hasil = subkriteria::where('kriteria', 'Kontribusi Ide Project')
                                    ->where('subkriteria', '>2')->value('nilai');
            }
        return $hasil;
    }

    public function ai_cek_keckom($keckom){

            if($keckom == 'A'){
                $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                    ->where('subkriteria', 'A')->value('nilai');
                return $hasil;
            }
            if($keckom == 'AB'){
                $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                    ->where('subkriteria', 'AB')->value('nilai');
                return $hasil;
            }else{
                $hasil = 0;
                return $hasil;
            }
        
    }

    public function ai_cek_kb($kb){
            if($kb == 'A'){
                $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                    ->where('subkriteria', 'A')->value('nilai');
                return $hasil;
            }
            if($kb == 'AB'){
                $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                    ->where('subkriteria', 'AB')->value('nilai');
                return $hasil;
            }else{
                $hasil = 0;
                return $hasil;
            }
    }

    public function ai_cek_pkb($pkb){
            if($pkb == 'A'){
                $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                    ->where('subkriteria', 'A')->value('nilai');
                return $hasil;
            }
            if($pkb == 'AB'){
                $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                    ->where('subkriteria', 'AB')->value('nilai');
                return $hasil;
            }else{
                $hasil = 0;
                return $hasil;
            }
    }

    public function ai_cek_datmin($datmin){
        if($datmin == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }
        if($datmin == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }

    public function ai_cek_sertiflomba($sertiflomba,$jmlBaris){
            if ($sertiflomba == null) {
                $hasil= subkriteria::where('kriteria', 'Mengikuti Kompetisi/Lomba')
                                        ->where('subkriteria', '<1')->value('nilai');
            } elseif($sertiflomba !== null && $jmlBaris>=1 && $jmlBaris<=2){
                $hasil= subkriteria::where('kriteria', 'Mengikuti Kompetisi/Lomba')
                                        ->where('subkriteria', '1-2')->value('nilai');
            }elseif($sertiflomba !== null && $jmlBaris>2){
                $hasil= subkriteria::where('kriteria', 'Mengikuti Kompetisi/Lomba')
                                        ->where('subkriteria', '>2')->value('nilai');
            }else{
                $hasil = 0;
            }
        
        return $hasil; 
        
    }

    public function ai_cek_organisasi($org){
        if($org == 'Bukan Pengurus'){
            $hasil = subkriteria::where('kriteria', 'Mengikuti Organisasi/Kepanitiaan')
                                ->where('subkriteria', 'Bukan Pengurus')->value('nilai');
            return $hasil;
        }
        if($org == 'Sebagai Pengurus'){
            $hasil = subkriteria::where('kriteria', 'Mengikuti Organisasi/Kepanitiaan')
                                ->where('subkriteria', 'Sebagai Pengurus')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }


    public function ai_insertnilai(){
        $data = data_alternatif::where('da_lab', 'Laboratorium Artificial Intelligence')->get();
        $da_lab = data_alternatif::where('da_lab', 'Laboratorium Artificial Intelligence')->value('da_lab');
        $da_ide = data_alternatif::where('da_lab', 'Laboratorium Artificial Intelligence')->value('ide_project');
        
        $processedNames = [];
        foreach($data as $item){
            $nama = $item->da_nama;
            $jmlData = data_alternatif::where('da_nama', $nama)->get();
            $jmlBaris = count($jmlData);
            if (in_array($nama, $processedNames)) {
                continue;
            }
            $processedNames[] = $nama;
            $sertiflomba = $item->da_sertif_prestasi;
            $nilai_lomba = $this->ai_cek_sertiflomba($sertiflomba,$jmlBaris);
            $org = $item->status_org;
            $nilai_organisasi = $this->ai_cek_organisasi($org);
            $nilai_tulis = $item->da_nilai_tulis;
            $nilai_wawancara = $item->da_nilai_wawancara;
            $keckom = $item->nilai_keckom;
            $nilai_keckom = $this->ai_cek_keckom($keckom);
            $kb = $item->nilai_kb;
            $nilai_kb = $this->ai_cek_kb($kb);
            $pkb = $item->nilai_pkb;
            $nilai_pkb = $this->ai_cek_pkb($pkb);
            $datmin = $item->nilai_datmin;
            $nilai_datmin = $this->ai_cek_datmin($datmin);
            $lab = $da_lab;
            $ide = $da_ide;
            $nilai_ide = $this->ai_cek_ide($ide,$jmlBaris);

            $existingRecord = nilai_alternatif::where('nama',$nama)
            ->where('lab', $da_lab)
            ->first();
            $data = [
                'nama'=>$nama,
                'nilai_sertif_prestasi'=>$nilai_lomba,
                'nilai_sertif_organisasi'=>$nilai_organisasi,
                'nilai_tulis'=>$nilai_tulis,
                'nilai_wawancara'=>$nilai_wawancara,
                'nilai_keckom'=>$nilai_keckom,
                'nilai_kb'=>$nilai_kb,
                'nilai_pkb'=>$nilai_pkb,
                'nilai_datmin'=>$nilai_datmin,
                'lab'=>$lab,
                'nilai_kontribusi_ide'=>$nilai_ide
            ];

            if(!$existingRecord){
                nilai_alternatif::create($data);
            }elseif($existingRecord){
                $existingRecord->update($data);
            }
        }
    }

    public function ai_utilitas(){
        $baris = nilai_alternatif::where('lab', 'Laboratorium Artificial Intelligence')->get();
        foreach($baris as $item){
            $nama = $item->nama;
            $nilai_sp = $item->nilai_sertif_prestasi;
            $nilai_so = $item->nilai_sertif_organisasi;
            $nilai_tulis = $item->nilai_tulis;
            $nilai_wawancara = $item->nilai_wawancara;
            $nilai_keckom = $item->nilai_keckom;
            $nilai_kb = $item->nilai_kb;
            $nilai_pkb = $item->nilai_pkb;
            $nilai_datmin = $item->nilai_datmin;
            $nilai_kontribusi_ide = $item->nilai_kontribusi_ide;
            $lab = $item->lab;
            $this->ai_rumus_uti($nama, $nilai_sp, $nilai_so, $nilai_tulis, $nilai_wawancara, $nilai_keckom, $nilai_kb, $nilai_pkb, $nilai_datmin, $nilai_kontribusi_ide,$lab);
        }
        return 'isert data berhasil';
    }

    public function ai_rumus_uti($nama, $nilai_sp, $nilai_so, $nilai_tulis, $nilai_wawancara, $nilai_keckom, $nilai_kb, $nilai_pkb, $nilai_datmin, $nilai_kontribusi_ide,$lab){
        // Retrieve the minimum and maximum values of each column in a single query
        $minMaxValues = nilai_alternatif::select(
            DB::raw('MIN(nilai_sertif_prestasi) as min_sp'),
            DB::raw('MAX(nilai_sertif_prestasi) as max_sp'),
            DB::raw('MIN(nilai_sertif_organisasi) as min_so'),
            DB::raw('MAX(nilai_sertif_organisasi) as max_so'),
            DB::raw('MIN(nilai_tulis) as min_tulis'),
            DB::raw('MAX(nilai_tulis) as max_tulis'),
            DB::raw('MIN(nilai_wawancara) as min_wawancara'),
            DB::raw('MAX(nilai_wawancara) as max_wawancara'),
            DB::raw('MIN(nilai_keckom) as min_keckom'),
            DB::raw('MAX(nilai_keckom) as max_keckom'),
            DB::raw('MIN(nilai_kb) as min_kb'),
            DB::raw('MAX(nilai_kb) as max_kb'),
            DB::raw('MIN(nilai_pkb) as min_pkb'),
            DB::raw('MAX(nilai_pkb) as max_pkb'),
            DB::raw('MIN(nilai_datmin) as min_datmin'),
            DB::raw('MAX(nilai_datmin) as max_datmin'),
            DB::raw('MIN(nilai_kontribusi_ide) as min_ide'),
            DB::raw('MAX(nilai_kontribusi_ide) as max_ide'),
            // Add more columns as needed
        )->first();

        if ($minMaxValues) {
            // Extract min and max values for each column
            $min_sp = $minMaxValues->min_sp;
            $max_sp = $minMaxValues->max_sp;
            $min_so = $minMaxValues->min_so;
            $max_so = $minMaxValues->max_so;
            $min_tulis = $minMaxValues->min_tulis;
            $max_tulis = $minMaxValues->max_tulis;
            $min_wawancara = $minMaxValues->min_wawancara;
            $max_wawancara = $minMaxValues->max_wawancara;
            $min_keckom = $minMaxValues->min_keckom;
            $max_keckom = $minMaxValues->max_keckom;
            $min_kb = $minMaxValues->min_kb;
            $max_kb = $minMaxValues->max_kb;
            $min_pkb = $minMaxValues->min_pkb;
            $max_pkb = $minMaxValues->max_pkb;
            $min_datmin = $minMaxValues->min_datmin;
            $max_datmin = $minMaxValues->max_datmin;
            $min_ide = $minMaxValues->min_ide;
            $max_ide = $minMaxValues->max_ide;
            // Extract min and max values for other columns similarly

            $uti_sp = ($max_sp != $min_sp) ? ($nilai_sp - $min_sp) / ($max_sp - $min_sp) : 0;
            $uti_so = ($max_so != $min_so) ? ($nilai_so - $min_so) / ($max_so - $min_so) : 0;
            $uti_tulis = ($max_tulis != $min_tulis) ? ($nilai_tulis - $min_tulis) / ($max_tulis - $min_tulis) : 0;
            $uti_wawancara = ($max_wawancara != $min_wawancara) ? ($nilai_wawancara - $min_wawancara) / ($max_wawancara - $min_wawancara) : 0;
            $uti_keckom = ($max_keckom != $min_keckom) ? ($nilai_keckom - $min_keckom) / ($max_keckom - $min_keckom) : 0;
            $uti_kb = ($max_kb != $min_kb) ? ($nilai_kb - $min_kb) / ($max_kb - $min_kb) : 0;
            $uti_pkb = ($max_pkb != $min_pkb) ? ($nilai_pkb - $min_pkb) / ($max_pkb - $min_pkb) : 0;
            $uti_datmin = ($max_datmin != $min_datmin) ? ($nilai_datmin - $min_datmin) / ($max_datmin - $min_datmin) : 0;
            $uti_kontribusi_ide = ($max_ide != $min_ide) ? ($nilai_kontribusi_ide - $min_ide) / ($max_ide - $min_ide) : 0;

            // Calculate the normalized values for other columns similarly
            $existingRecord = utilitas::where('nama',$nama)
            ->where('lab', $lab)
            ->first();
            $data = [
                'nama'=>$nama,
                'uti_sertif_prestasi'=>$uti_sp,
                'uti_sertif_organisasi'=>$uti_so,
                'uti_tulis'=>$uti_tulis,
                'uti_wawancara'=>$uti_wawancara,
                'uti_keckom'=>$uti_keckom,
                'uti_kb'=>$uti_kb,
                'uti_pkb'=>$uti_pkb,
                'uti_datmin'=>$uti_datmin,
                'uti_kontribusi_ide'=>$uti_kontribusi_ide,
                'lab'=>$lab
            ];

            if(!$existingRecord){
                    utilitas::create($data);
            }else{
                $existingRecord->update($data);
            }
        } else {
        }
        // Now you have the normalized values for each column
    }

    public function ai_nilai_akhir(){
        $norm_sp = normalisasi::where('norm_kriteria', 'Mengikuti Kompetisi/Lomba')
                            ->where('lab', 'Laboratorium Artificial Intelligence')->value('normalisasi');
        $norm_so = normalisasi::where('norm_kriteria', 'Mengikuti Organisasi/Kepanitiaan')->value('normalisasi');
        // $norm_tulis = normalisasi::where('norm_kriteria', 'Tes Tulis')->value('normalisasi');
        $norm_wawancara = normalisasi::where('norm_kriteria', 'Tes Wawancara')
                                        ->where('lab', 'Laboratorium Artificial Intelligence')->value('normalisasi');
        $norm_matkul = normalisasi::where('norm_kriteria', 'Nilai Mata Kuliah')
                                    ->where('lab', 'Laboratorium Artificial Intelligence')->value('normalisasi');
        $norm_ide = normalisasi::where('norm_kriteria', 'Kontribusi Ide Project')
                                ->where('lab', 'Laboratorium Artificial Intelligence')->value('normalisasi');


        $data = utilitas::where('lab', 'Laboratorium Artificial Intelligence')->get();
        // $jmlbaris2 = count($baris2);
        // $data2 = utilitas::paginate($jmlbaris2);

        // $j = $data->firstItem();

        foreach($data as $item2){
            $nama = $item2->nama;
            $sp = $item2->uti_sertif_prestasi;
            $na_sp = $sp * $norm_sp;
            $so = $item2->uti_sertif_organisasi;
            $na_so = $so * $norm_so;
            $wawancara = $item2->uti_wawancara;
            $na_wawancara = $wawancara * $norm_wawancara;
            $keckom = $item2->uti_keckom;
            $na_keckom = $keckom * $norm_matkul;
            $kb = $item2->uti_kb;
            $na_kb = $kb * $norm_matkul;
            $pkb = $item2->uti_pkb;
            $na_pkb = $pkb * $norm_matkul;
            $datmin = $item2->uti_datmin;
            $na_datmin = $datmin * $norm_matkul;
            $ide = $item2->uti_kontribusi_ide;
            $na_ide = $ide * $norm_ide;
            $lab = $item2->lab;

            $total = $na_sp+$na_so+$na_wawancara+$na_keckom+$na_kb+$na_pkb+$na_datmin+$na_ide;

            
            $existingRecord = nilai_akhir::where('nama',$nama)
            ->where('lab', $lab)
            ->first();
            $data = [
                'nama'=>$nama,
                'na_sertif_prestasi'=>$na_sp,
                'na_sertif_organisasi'=>$na_so,
                // 'na_tulis'=>$na_tulis,
                'na_wawancara'=>$na_wawancara,
                'na_keckom'=>$na_keckom,
                'na_kb'=>$na_kb,
                'na_pkb'=>$na_pkb,
                'na_datmin'=>$na_datmin,
                'na_kontribusi_ide'=>$na_ide,
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

    //END FUNCTION KHUSUS LAB AI

    
    public function test(){
        
    }
}
