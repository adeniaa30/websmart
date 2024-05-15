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
use Illuminate\Support\Facades\Log;

class smartController extends Controller
{
    public function smart(Request $request){
        //BIKIN LOG
        
        //NORMALISASI KRITERIA
        $jumlahbaris = 10;
        $totalSum = kriteria::sum('bobot');
        $kriterias = kriteria::all();

        foreach ($kriterias as $kriteria) {
            $normBobot = $kriteria->bobot;
            $normKriteria = $kriteria->kriteria;
            $normalisasi = $kriteria->bobot / $totalSum;
            $existingRecord = Normalisasi::where('norm_kriteria', $normKriteria)->first();

            if (!$existingRecord) {
                // If no existing record found, proceed with insertion
                $isi = [
                    'norm_kriteria' => $normKriteria,
                    'norm_bobot' => $normBobot,
                    'normalisasi' => $normalisasi,
                ];
                Normalisasi::create($isi);
            } else {
                // Handle duplication: Skip insertion, log, or perform other actions
                // For example, you can log the duplication or skip the insertion
                // Log::info('Duplicate record found for norm_kriteria: ' . $normKriteria);
            }
        }
        $data = normalisasi::paginate($jumlahbaris);

        $this->insertnilai();
        $nilai_alt = nilai_alternatif::paginate($jumlahbaris);
        
        $this->utilitas();
        $uti = utilitas::paginate($jumlahbaris);

        $this->nilai_akhir();
        $na = nilai_akhir::paginate($jumlahbaris);

        $final = 0;
        $rank = [];
        $result = [];
        $hasil = [];
        $nilai = nilai_akhir::all(); // Fetch all rows from the table
        // $i = $nilai->firstItem();

        foreach ($nilai as $index => $item) {
            $final = $item->na_ipk + $item->na_sertif_prestasi + $item->na_sertif_organisasi + $item->na_tulis + $item->na_wawancara + $item->na_matkulx;
            // $i+=1;
            $result[$index] = $final;
        }

        arsort($result); 

        $prevValue = null;
        $prevRank = 0;
        foreach ($result as $index => $value) {
            if ($value !== $prevValue) {
                $prevRank++;
            }
            $rank[$index] = $prevRank;
            $prevValue = $value;
        }

        // foreach ($result as $index => $value) {
        //     $hasil[] = "Index: $index, Result: $value, Rank: " . $rank[$index];
        // }

        // $totalSum now contains the sum of values from the specified columns in all rows


        $cmin = nilai_alternatif::select(DB::raw('MIN(nilai_ipk) as min_ipk'))
        ->selectRaw('MIN(nilai_sertif_prestasi) as min_sp')
        ->selectRaw('MIN(nilai_sertif_organisasi) as min_so')
        ->selectRaw('MIN(nilai_tulis) as min_tulis')
        ->selectRaw('MIN(nilai_wawancara) as min_wawancara')
        ->selectRaw('MIN(nilai_matkulx) as min_x')
        ->selectRaw('MIN(nilai_matkuly) as min_y')
        ->selectRaw('MIN(nilai_matkulz) as min_z')
        ->first();
        $cmax = nilai_alternatif::select(DB::raw('MAX(nilai_ipk) as max_ipk'))
        ->selectRaw('MAX(nilai_sertif_prestasi) as max_sp')
        ->selectRaw('MAX(nilai_sertif_organisasi) as max_so')
        ->selectRaw('MAX(nilai_tulis) as max_tulis')
        ->selectRaw('MAX(nilai_wawancara) as max_wawancara')
        ->selectRaw('MAX(nilai_matkulx) as max_x')
        ->selectRaw('MAX(nilai_matkuly) as max_y')
        ->selectRaw('MAX(nilai_matkulz) as max_z')
        ->first();

        return view('admin.spk', [
            'data' => $data,
            'totalSum' => $totalSum,
            'nilai_alt'=> $nilai_alt,
            'cmin'=> $cmin,
            'cmax'=> $cmax,
            'uti' => $uti,
            'na' => $na,
            'result' => $result,
            'rank' => $rank,
        ]);
    }

    public function cekipk($a)
    {
        // CEK NILAI IPK
        // $alldata = data_alternatif::all();

        // foreach ($alldata as $data) {
            // $ipk = $data->da_ipk;

            if ($a < 3) {
                $hasil = subkriteria::where('kriteria', 'IP')
                                    ->where('subkriteria', '<', 3)
                                    ->value('nilai');
            } elseif ($a >= 3 && $a < 3.5) {
                $hasil = subkriteria::where('kriteria', 'IP')
                                    ->where('subkriteria', '3,1-3,5')
                                    ->value('nilai');
            } elseif ($a >= 3.5 && $a <= 4) {
                $hasil = subkriteria::where('subkriteria', '3,6-4')
                                    ->value('nilai');
            }
            return $hasil;
        // }

        // return $hasil;

            
    }


    public function ceknilaisertifprestasi($b){

            if ($b) {
                $hasil= subkriteria::where('kriteria', 'Prestasi/Portofolio')
                                        ->where('subkriteria', '1-5')->value('nilai');
            } else{
                $hasil= subkriteria::where('kriteria', 'Prestasi/Portofolio')
                                        ->where('subkriteria', 'krg dr 1')->value('nilai');
            }
        
        return $hasil; 
    }

    public function ceknilaisertiforganisasi($c){
            // Check if the sertif_prestasi field is not null
            if ($c) {
                $hasil = subkriteria::where('kriteria', 'Pengalaman Organisasi')
                                        ->where('subkriteria', '1-5')->value('nilai');
                // File exists in the column
                return $hasil;
            } else{
                $hasil = subkriteria::where('kriteria', 'Pengalaman Organisasi')
                                        ->where('subkriteria', 'krg dr 1')->value('nilai');
                // File exists in the column
                return $hasil;
            }
    }

    public function ceknilaitestulis(){
        $record = data_alternatif::first();
        $hasil = $record->da_nilai_tulis;
        return $hasil;
    }

    public function ceknilaiteswawancara(){
        $record = data_alternatif::first();
        $hasil = $record->da_nilai_wawancara;
        return $hasil;
    }

    public function ceknilaimatkulx($f){

        if($f == 'A'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'A')->value('nilai');
            return $nilai_sub;
        }elseif($f == 'AB'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'AB')->value('nilai');
            return $nilai_sub;
        }elseif($f == 'B'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'B')->value('nilai');
            return $nilai_sub;
        }
    }

    public function ceknilaimatkuly($g){

        if($g == 'A'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'A')->value('nilai');
            return $nilai_sub;
        }elseif($g == 'AB'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'AB')->value('nilai');
            return $nilai_sub;
        }elseif($g == 'B'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'B')->value('nilai');
            return $nilai_sub;
        }
    }

    public function ceknilaimatkulz($h){

        if($h == 'A'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'A')->value('nilai');
            return $nilai_sub;
        }elseif($h == 'AB'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'AB')->value('nilai');
            return $nilai_sub;
        }elseif($h == 'B'){
            $nilai_sub = subkriteria::where('kriteria','Nilai Matkul')
                                    ->where('subkriteria', 'B')->value('nilai');
            return $nilai_sub;
        }
    }

    public function insertnilai(){
        //INSERT DATA NILAI ALTERNATIF

        $baris = data_alternatif::all();
        $jmlbaris = count($baris);
        $data = data_alternatif::paginate($jmlbaris);
        $i = $data->firstItem();
        $nilai = [];

        foreach($data as $item){
            $nama = $item->da_nama;
            $a = $item->da_ipk;
            $nilai_ipk = $this->cekipk($a);
            $b = $item->da_sertif_prestasi;
            $nilai_sp = $this->ceknilaisertifprestasi($b);
            $c = $item->da_sertif_organisasi;
            $nilai_so = $this->ceknilaisertiforganisasi($c);
            $d = $item->da_nilai_tulis;
            $e = $item->da_nilai_wawancara;
            $f = $item->da_nilai_matkulx;
            $nilai_matkulx = $this->ceknilaimatkulx($f);
            $g = $item->da_nilai_matkuly;
            $nilai_matkuly = $this->ceknilaimatkuly($g);
            $h = $item->da_nilai_matkulz;
            $nilai_matkulz = $this->ceknilaimatkulz($h);
            $existingRecord = nilai_alternatif::where('nama', $nama)->first();

            if(!$existingRecord){
                $data = [
                    'nama'=>$nama,
                    'nilai_ipk'=>$nilai_ipk,
                    'nilai_sertif_prestasi'=>$nilai_sp,
                    'nilai_sertif_organisasi'=>$nilai_so,
                    'nilai_tulis'=>$d,
                    'nilai_wawancara'=>$e,
                    'nilai_matkulx'=>$nilai_matkulx,
                    'nilai_matkuly'=>$nilai_matkuly,
                    'nilai_matkulz'=>$nilai_matkulz
                ];
                    nilai_alternatif::create($data);
            }else{
                // return 'data sudah ada';
            }
            // $nilai2[] = $nama.$nilai_ipk.$nilai_sp.$nilai_so.$d.$e.$nilai_matkulx.$nilai_matkuly.$nilai_matkulz;
            $i+=1;
        }
            // return 'insert data berhasil';
    }

    public function utilitas(){
        $baris = nilai_alternatif::all();
        $jmlbaris = count($baris);
        $data = nilai_alternatif::paginate($jmlbaris);
        $i = $data->firstItem();
        $hasil = [];

        foreach($data as $item){
            $nama = $item->nama;
            $nilai_ipk = $item->nilai_ipk;
            $nilai_sp = $item->nilai_sertif_prestasi;
            $nilai_so = $item->nilai_sertif_organisasi;
            $nilai_tulis = $item->nilai_tulis;
            $nilai_wawancara = $item->nilai_wawancara;
            $nilai_matkulx = $item->nilai_matkulx;
            $nilai_matkuly = $item->nilai_matkuly;
            $nilai_matkulz = $item->nilai_matkulz;
            $this->rumus_uti($nama, $nilai_ipk, $nilai_sp, $nilai_so, $nilai_tulis, $nilai_wawancara, $nilai_matkulx, $nilai_matkuly, $nilai_matkulz);
            
            // $hasil[] = $i.' '.$nilai_uti;
            $i+=1;
        }
        return 'isert data berhasil';
    }

    public function rumus_uti($nama, $nilai_ipk, $nilai_sp, $nilai_so, $nilai_tulis, $nilai_wawancara, $nilai_matkulx, $nilai_matkuly, $nilai_matkulz){
        // Retrieve the minimum and maximum values of each column in a single query
        $minMaxValues = nilai_alternatif::select(
            DB::raw('MIN(nilai_ipk) as min_ipk'),
            DB::raw('MAX(nilai_ipk) as max_ipk'),
            DB::raw('MIN(nilai_sertif_prestasi) as min_sp'),
            DB::raw('MAX(nilai_sertif_prestasi) as max_sp'),
            DB::raw('MIN(nilai_sertif_organisasi) as min_so'),
            DB::raw('MAX(nilai_sertif_organisasi) as max_so'),
            DB::raw('MIN(nilai_tulis) as min_tulis'),
            DB::raw('MAX(nilai_tulis) as max_tulis'),
            DB::raw('MIN(nilai_wawancara) as min_wawancara'),
            DB::raw('MAX(nilai_wawancara) as max_wawancara'),
            DB::raw('MIN(nilai_matkulx) as min_matkulx'),
            DB::raw('MAX(nilai_matkulx) as max_matkulx'),
            DB::raw('MIN(nilai_matkuly) as min_matkuly'),
            DB::raw('MAX(nilai_matkuly) as max_matkuly'),
            DB::raw('MIN(nilai_matkulz) as min_matkulz'),
            DB::raw('MAX(nilai_matkulz) as max_matkulz'),
            // Add more columns as needed
        )->first();

        if ($minMaxValues) {
            // Extract min and max values for each column
            $min_ipk = $minMaxValues->min_ipk;
            $max_ipk = $minMaxValues->max_ipk;
            $min_sp = $minMaxValues->min_sp;
            $max_sp = $minMaxValues->max_sp;
            $min_so = $minMaxValues->min_so;
            $max_so = $minMaxValues->max_so;
            $min_tulis = $minMaxValues->min_tulis;
            $max_tulis = $minMaxValues->max_tulis;
            $min_wawancara = $minMaxValues->min_wawancara;
            $max_wawancara = $minMaxValues->max_wawancara;
            $min_matkulx = $minMaxValues->min_matkulx;
            $max_matkulx = $minMaxValues->max_matkulx;
            $min_matkuly = $minMaxValues->min_matkuly;
            $max_matkuly = $minMaxValues->max_matkuly;
            $min_matkulz = $minMaxValues->min_matkulz;
            $max_matkulz = $minMaxValues->max_matkulz;
            // Extract min and max values for other columns similarly

            // Calculate the normalized values for each column
            $uti_ipk = ($max_ipk != $min_ipk) ? ($nilai_ipk - $min_ipk) / ($max_ipk - $min_ipk) : 0;
            $uti_sp = ($max_sp != $min_sp) ? ($nilai_sp - $min_sp) / ($max_sp - $min_sp) : 0;
            $uti_so = ($max_so != $min_so) ? ($nilai_so - $min_so) / ($max_so - $min_so) : 0;
            $uti_tulis = ($max_tulis != $min_tulis) ? ($nilai_tulis - $min_tulis) / ($max_tulis - $min_tulis) : 0;
            $uti_wawancara = ($max_wawancara != $min_wawancara) ? ($nilai_wawancara - $min_wawancara) / ($max_wawancara - $min_wawancara) : 0;
            $uti_matkulx = ($max_matkulx != $min_matkulx) ? ($nilai_matkulx - $min_matkulx) / ($max_matkulx - $min_matkulx) : 0;
            $uti_matkuly = ($max_matkuly != $min_matkuly) ? ($nilai_matkuly - $min_matkuly) / ($max_matkuly - $min_matkuly) : 0;
            $uti_matkulz = ($max_matkulz != $min_matkulz) ? ($nilai_matkulz - $min_matkulz) / ($max_matkulz - $min_matkulz) : 0;
            // Calculate the normalized values for other columns similarly

            $existingRecord = utilitas::where('nama', $nama)->first();

            if(!$existingRecord){
                $data = [
                    'nama'=>$nama,
                    'uti_ipk'=>$uti_ipk,
                    'uti_sertif_prestasi'=>$uti_sp,
                    'uti_sertif_organisasi'=>$uti_so,
                    'uti_tulis'=>$uti_tulis,
                    'uti_wawancara'=>$uti_wawancara,
                    'uti_matkulx'=>$uti_matkulx,
                    'uti_matkuly'=>$uti_matkuly,
                    'uti_matkulz'=>$uti_matkulz,
                ];
                    utilitas::create($data);
            }else{
                return 'data sudah ada';
            }
        } else {
            // Handle case where no records are found
            $uti_ipk = $uti_sp = 0; // Set default values
            // Set default values for other columns similarly
        }
        // Now you have the normalized values for each column
    }

    public function nilai_akhir(){
        // $baris = normalisasi::all();
        // $jmlbaris = count($baris);
        // $data = normalisasi::paginate($jmlbaris);
        $norm_ipk = normalisasi::where('norm_kriteria', 'IP')->value('normalisasi');
        $norm_sp = normalisasi::where('norm_kriteria', 'Prestasi/Portofolio')->value('normalisasi');
        $norm_so = normalisasi::where('norm_kriteria', 'Pengalaman Organisasi')->value('normalisasi');
        $norm_tulis = normalisasi::where('norm_kriteria', 'Tes Tulis')->value('normalisasi');
        $norm_wawancara = normalisasi::where('norm_kriteria', 'Tes Wawancara')->value('normalisasi');
        $norm_matkul = normalisasi::where('norm_kriteria', 'Nilai Matkul')->value('normalisasi');

        $baris2 = utilitas::all();
        $jmlbaris2 = count($baris2);
        $data2 = utilitas::paginate($jmlbaris2);

        $j = $data2->firstItem();

        foreach($data2 as $item2){
            $nama = $item2->nama;
            $ipk = $item2->uti_ipk;
            $na_ipk = $ipk * $norm_ipk;
            $sp = $item2->uti_sertif_prestasi;
            $na_sp = $sp * $norm_sp;
            $so = $item2->uti_sertif_organisasi;
            $na_so = $so * $norm_so;
            $tulis = $item2->uti_tulis;
            $na_tulis = $tulis * $norm_tulis;
            $wawancara = $item2->uti_wawancara;
            $na_wawancara = $wawancara * $norm_wawancara;
            $x = $item2->uti_matkulx;
            $na_matkulx = $x * $norm_matkul;
            $y = $item2->uti_matkuly;
            $na_matkuly = $y * $norm_matkul;
            $z = $item2->uti_matkulz;
            $na_matkulz = $z * $norm_matkul;
            
            $existingRecord = nilai_akhir::where('nama', $nama)->first();
            if(!$existingRecord){
                $data3 = [
                    'nama'=>$nama,
                    'na_ipk'=>$na_ipk,
                    'na_sertif_prestasi'=>$na_sp,
                    'na_sertif_organisasi'=>$na_so,
                    'na_tulis'=>$na_tulis,
                    'na_wawancara'=>$na_wawancara,
                    'na_matkulx'=>$na_matkulx,
                    'na_matkuly'=>$na_matkuly,
                    'na_matkulz'=>$na_matkulz
                ];
                try{
                    nilai_akhir::create($data3);
                    Log::info('New record inserted for ' . $nama);
                }catch (\Exception $e) {
                    Log::error('Error inserting record for ' . $nama . ': ' . $e->getMessage());
                    return 'Error inserting record for ' . $nama;
                }
            }else{
                return 'data sudah ada';
            }
            
            $j+=1;
        }
    }

    public function test(){
        $final = 0;
        $rank = [];
        $result = [];
        $hasil = [];
        $baris = count($result);
        $nilai = nilai_akhir::all(); // Fetch all rows from the table
        // $i = $nilai->firstItem();

        foreach ($nilai as $index => $item) {
            $final = $item->na_ipk + $item->na_sertif_prestasi + $item->na_sertif_organisasi + $item->na_tulis + $item->na_wawancara + $item->na_matkulx;
            // $i+=1;
            $result[$index] = $final;
        }

        arsort($result); 

        $prevValue = null;
        $prevRank = 0;
        foreach ($result as $index => $value) {
            if ($value !== $prevValue) {
                $prevRank++;
            }
            $rank[$index] = $prevRank;
            $prevValue = $value;
        }

        foreach ($result as $index => $value) {
            $hasil[] = "Index: $index, Result: $value, Rank: " . $rank[$index];
        }
        
        return $hasil;

    }
}
