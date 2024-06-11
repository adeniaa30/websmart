<?php

namespace App\Http\Controllers;

use App\Models\data_rpl;
use App\Models\kriteria;
use App\Models\nilai_akhir;
use App\Models\nilai_alternatif;
use App\Models\nilai_rpl;
use App\Models\nilaiakhir_rpl;
use App\Models\normalisasi;
use App\Models\subkriteria;
use App\Models\uti_rpl;
use App\Models\utilitas;
use Illuminate\Http\Request;

class smartRPLController extends Controller
{
    public function smart(){
        $jumlahbaris = 10;
        $totalSum = kriteria::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->sum('bobot');
        $kriterias = kriteria::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->get();

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
                normalisasi::create($isi);
            } else {
                // Handle duplication: Skip insertion, log, or perform other actions
                // For example, you can log the duplication or skip the insertion
                // Log::info('Duplicate record found for norm_kriteria: ' . $normKriteria);
            }
        }
        // $this->it_insertnilai();
        // $this->it_utilitas();
        // $this->it_nilai_akhir();
        $na = nilaiakhir_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);
        $data = normalisasi::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);
        $nilai_alt = nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);
        $uti = uti_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);



        $final = 0;
        $rank = [];
        $result = [];
        $hasil = [];
        $nilai = nilaiakhir_rpl::all(); // Fetch all rows from the table
        $total = nilaiakhir_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')
            ->orderBy('total', 'desc')
            ->get();

        $cmin = nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')
        ->selectRaw('MIN(algo1) as min_algo1')
        ->selectRaw('MIN(pbo) as min_pbo')
        ->selectRaw('MIN(sql) as min_sql')
        ->selectRaw('MIN(pweb) as min_pweb')
        ->selectRaw('MIN(paa) as min_paa')
        ->selectRaw('MIN(uiux) as min_uiux')
        ->selectRaw('MIN(ood) as min_ood')
        ->selectRaw('MIN(algo2) as min_algo2')
        ->selectRaw('MIN(pmobile) as min_pmobile')
        ->selectRaw('MIN(sbd) as min_sbd')
        ->selectRaw('MIN(tkti) as min_tkti')
        ->selectRaw('MIN(adpl) as min_adpl')
        ->selectRaw('MIN(mpti) as min_mpti')
        ->selectRaw('MIN(ppla) as min_ppla')
        ->selectRaw('MIN(visi) as min_visi')
        ->selectRaw('MIN(wawasan) as min_wawasan')
        ->selectRaw('MIN(komitmen) as min_komitmen')
        ->selectRaw('MIN(fairness) as min_fairness')
        ->selectRaw('MIN(teamwork) as min_teamwork')
        ->selectRaw('MIN(potensi) as min_potensi')
        ->selectRaw('MIN(analisis) as min_analisis')
        ->selectRaw('MIN(technical) as min_technical')
        ->selectRaw('MIN(portofolio) as min_portofolio')
        ->first();
        $cmax = nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')
        ->selectRaw('MAX(algo1) as max_algo1')
        ->selectRaw('MAX(pbo) as max_pbo')
        ->selectRaw('MAX(sql) as max_sql')
        ->selectRaw('MAX(pweb) as max_pweb')
        ->selectRaw('MAX(paa) as max_paa')
        ->selectRaw('MAX(uiux) as max_uiux')
        ->selectRaw('MAX(ood) as max_ood')
        ->selectRaw('MAX(algo2) as max_algo2')
        ->selectRaw('MAX(pmobile) as max_pmobile')
        ->selectRaw('MAX(sbd) as max_sbd')
        ->selectRaw('MAX(tkti) as max_tkti')
        ->selectRaw('MAX(adpl) as max_adpl')
        ->selectRaw('MAX(mpti) as max_mpti')
        ->selectRaw('MAX(ppla) as max_ppla')
        ->selectRaw('MAX(visi) as max_visi')
        ->selectRaw('MAX(wawasan) as max_wawasan')
        ->selectRaw('MAX(komitmen) as max_komitmen')
        ->selectRaw('MAX(fairness) as max_fairness')
        ->selectRaw('MAX(teamwork) as max_teamwork')
        ->selectRaw('MAX(potensi) as max_potensi')
        ->selectRaw('MAX(analisis) as max_analisis')
        ->selectRaw('MAX(technical) as max_technical')
        ->selectRaw('MAX(portofolio) as max_portofolio')
        ->first();

        return view('admin.spk_rpl', [
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
        $data = data_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->get();
        $da_lab = data_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('lab');
        // $da_kom = data_alternatif::where('da_lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('ai_komunikasi_kerja');
        // $da_ide = data_alternatif::where('da_lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('ide_project');
        
        $processedNames = [];
        $result = [];
        foreach($data as $item){
            $nama = $item->nama;
            $lab = $item->lab;
            $jmlData = data_rpl::where('nama', $nama)->get();
            $jmlBaris = count($jmlData);
            if (in_array($nama, $processedNames)) {
                continue;
            }
            $processedNames[] = $nama;
            $algo1 = $item->algo1;
            $nilai_algo1 = $this->cek_algo1($algo1);
            $pbo = $item->pbo;
            $nilai_pbo = $this->cek_pbo($pbo);
            $sql = $item->sql;
            $nilai_sql = $this->cek_sql($sql);
            $pweb = $item->pweb;
            $nilai_pweb = $this->cek_pweb($pweb);
            $paa = $item->paa;
            $nilai_paa = $this->cek_paa($paa);
            $uiux = $item->uiux;
            $nilai_uiux = $this->cek_uiux($uiux);
            $ood = $item->ood;
            $nilai_ood = $this->cek_ood($ood);
            $algo2 = $item->algo2;
            $nilai_algo2 = $this->cek_algo2($algo2);
            $pmobile = $item->pmobile;
            $nilai_pmobile = $this->cek_pmobile($pmobile);
            $sbd = $item->sbd;
            $nilai_sbd = $this->cek_sbd($sbd);
            $tkti = $item->tkti;
            $nilai_tkti = $this->cek_tkti($tkti);
            $adpl = $item->adpl;
            $nilai_adpl = $this->cek_adpl($adpl);
            $mpti = $item->mpti;
            $nilai_mpti = $this->cek_mpti($mpti);
            $ppla = $item->ppla;
            $nilai_ppla = $this->cek_ppla($ppla);
            $visi = $item->visi;
            $nilai_visi = $this->cek_visi($visi);
            $wawasan = $item->wawasan;
            $nilai_wawasan = $this->cek_wawasan($wawasan);
            $komitmen = $item->komitmen;
            $nilai_komitmen = $this->cek_komitmen($komitmen);
            $fairness = $item->fairness;
            $nilai_fairness = $this->cek_fairness($fairness);
            $teamwork = $item->teamwork;
            $nilai_teamwork = $this->cek_teamwork($teamwork);
            $potensi = $item->potensi;
            $nilai_potensi = $this->cek_potensi($potensi);
            $analisis = $item->analisis;
            $nilai_analisis = $this->cek_analisis($analisis);
            $technical = $item->technical;
            $nilai_technical = $this->cek_technical($technical);
            $portofolio = $item->portofolio;
            $nilai_portofolio = $this->cek_portofolio($portofolio);


            $existingRecord = nilai_rpl::where('nama',$nama)->where('lab', $lab)->first();
            $data = [
                'nama'=>$nama,
                'lab'=>$lab,
                'algo1'=>$nilai_algo1,
                'pbo'=>$nilai_pbo,
                'sql'=>$nilai_sql,
                'pweb'=>$nilai_pweb,
                'paa'=>$nilai_paa,
                'uiux'=>$nilai_uiux,
                'ood'=>$nilai_ood,
                'algo2'=>$nilai_algo2,
                'pmobile'=>$nilai_pmobile,
                'sbd'=>$nilai_sbd,
                'tkti'=>$nilai_tkti,
                'adpl'=>$nilai_adpl,
                'mpti'=>$nilai_mpti,
                'ppla'=>$nilai_ppla,
                'visi'=>$nilai_visi,
                'wawasan'=>$nilai_wawasan,
                'komitmen'=>$nilai_komitmen,
                'fairness'=>$nilai_fairness,
                'teamwork'=>$nilai_teamwork,
                'potensi'=>$nilai_potensi,
                'analisis'=>$nilai_analisis,
                'technical'=>$nilai_technical,
                'portofolio'=>$nilai_portofolio,        
            ];

            if(!$existingRecord){
                nilai_rpl::create($data);
                // return 'insert data berhasil';
            }elseif($existingRecord){
                $existingRecord->update($data);
            }
        }
    }

    public function cek_algo1($algo1){
        if($algo1 == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (RPL)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }elseif($algo1 == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (RPL)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }elseif($algo1 == 'B'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (RPL)')
            ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
        }
    }

    public function cek_pbo($pbo){
        if($pbo == 'A'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (RPL)')
                                ->where('subkriteria', 'A')->value('nilai');
            return $hasil;
        }elseif($pbo == 'AB'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (RPL)')
                                ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }elseif($pbo == 'B'){
            $hasil = subkriteria::where('kriteria', 'Nilai Mata Kuliah (RPL)')
            ->where('subkriteria', 'AB')->value('nilai');
            return $hasil;
        }else{
            $hasil = 0;
        }
    }



}
