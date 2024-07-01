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
use Illuminate\Support\Facades\DB;

class smartRPLController extends Controller
{
    public function smart(){
        $jumlahbaris = 15;
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
        $this->insertnilai();
        $this->utilitas();
        $this->nilai_akhir();
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

            $cmin = [
                'min_algo1' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('algo1'),
                'min_pbo' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('pbo'),
                'min_sql' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('sql'),
                'min_pweb' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('pweb'),
                'min_paa' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('paa'),
                'min_uiux' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('uiux'),
                'min_ood' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('ood'),
                'min_algo2' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('algo2'),
                'min_pmobile' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('pmobile'),
                'min_sbd' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('sbd'),
                'min_tkti' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('tkti'),
                'min_adpl' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('adpl'),
                'min_mpti' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('mpti'),
                'min_ppla' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('ppla'),
                'min_visi' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('visi'),
                'min_wawasan' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('wawasan'),
                'min_komitmen' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('komitmen'),
                'min_fairness' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('fairness'),
                'min_teamwork' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('teamwork'),
                'min_potensi' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('potensi'),
                'min_analisis' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('analisis'),
                'min_technical' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('technical'),
                'min_portofolio' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->min('portofolio'),
            ];
            
            $cmax = [
                'max_algo1' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('algo1'),
                'max_pbo' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('pbo'),
                'max_sql' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('sql'),
                'max_pweb' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('pweb'),
                'max_paa' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('paa'),
                'max_uiux' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('uiux'),
                'max_ood' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('ood'),
                'max_algo2' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('algo2'),
                'max_pmobile' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('pmobile'),
                'max_sbd' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('sbd'),
                'max_tkti' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('tkti'),
                'max_adpl' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('adpl'),
                'max_mpti' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('mpti'),
                'max_ppla' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('ppla'),
                'max_visi' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('visi'),
                'max_wawasan' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('wawasan'),
                'max_komitmen' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('komitmen'),
                'max_fairness' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('fairness'),
                'max_teamwork' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('teamwork'),
                'max_potensi' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('potensi'),
                'max_analisis' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('analisis'),
                'max_technical' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('technical'),
                'max_portofolio' => nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->max('portofolio'),
            ];
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

    public function kategori_hasil(Request $request){
        $lolos = $request->input('lolos');
    
        $data = nilaiakhir_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')
        ->orderBy('total', 'desc')
        ->get(); 

        $counter = 0;
        
        foreach ($data as $item) {
            if ($counter < $lolos) {
                $status = 'LOLOS';
            } else {
                $status = 'GAGAL';
            }
            $item->status = $status;
            $item->save();
            
            $counter+=1;
        }
        
        // Return a view or redirect to show categorized data
        return redirect()->route('smartrpl')->with('success', 'Data Berhasil Diupdate!');    
    }

    public function insertnilai(){
        $data = data_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->get();
        $da_lab = data_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('lab');
        // $da_kom = data_alternatif::where('da_lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('ai_komunikasi_kerja');
        // $da_ide = data_alternatif::where('da_lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('ide_project');
        
        $processedNames = [];
        $result = [];
        foreach($data as $item){
            $nama = $item->nama;
            $nim = $item->nim;
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
            $portofolio = $item->detail_porto;
            $nilai_portofolio = $this->cek_portofolio($portofolio, $jmlBaris);


            $existingRecord = nilai_rpl::where('nama',$nama)->where('lab', $lab)->first();
            $data = [
                'nim' => $nim,
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

    public function getNilaiMatkul($subkriteria)
    {
        return subkriteria::where('kriteria', 'Nilai Mata Kuliah (RPL)')
                        ->where('subkriteria', $subkriteria)
                        ->value('nilai') ?? 0;
    }

    public function cek_algo1($algo1){
        if (in_array($algo1, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($algo1);
        } else {
            return 0;
        }    
    }

    public function cek_pbo($pbo){
    if (in_array($pbo, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($pbo);
        } else {
            return 0;
        }    
    }
    public function cek_sql($sql){
        if (in_array($sql, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($sql);
        } else {
            return 0;
        }    
    }
    public function cek_pweb($pweb){
        if (in_array($pweb, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($pweb);
        } else {
            return 0;
        }    
    }
    public function cek_paa($paa){
        if (in_array($paa, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($paa);
        } else {
            return 0;
        }    
    }
    public function cek_uiux($uiux){
        if (in_array($uiux, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($uiux);
        } else {
            return 0;
        }    
    }
    public function cek_ood($ood){
        if (in_array($ood, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($ood);
        } else {
            return 0;
        }    
    }
    public function cek_algo2($algo2){
        if (in_array($algo2, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($algo2);
        } else {
            return 0;
        }    
    }
    public function cek_pmobile($pmobile){
        if (in_array($pmobile, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($pmobile);
        } else {
            return 0;
        }    
    }
    public function cek_sbd($sbd){
        if (in_array($sbd, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($sbd);
        } else {
            return 0;
        }    
    }
    public function cek_tkti($tkti){
        if (in_array($tkti, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($tkti);
        } else {
            return 0;
        }    
    }
    public function cek_adpl($adpl){
        if (in_array($adpl, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($adpl);
        } else {
            return 0;
        }    
    }
    public function cek_mpti($mpti){
        if (in_array($mpti, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($mpti);
        } else {
            return 0;
        }    
    }
    public function cek_ppla($ppla){
        if (in_array($ppla, ['A', 'AB', 'B'])) {
            return $this->getNilaiMatkul($ppla);
        } else {
            return 0;
        }    
    }
    public function cek_visi($visi){
        if (in_array($visi, ['1', '2', '3', '4', '5'])) {
            // return $this->getNilaiMatkul($visi);
            $hasil = subkriteria::where('kriteria', 'Visi')
            ->where('subkriteria', $visi)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_wawasan($wawasan){
        if (in_array($wawasan, ['1', '2', '3', '4', '5'])) {
            $hasil = subkriteria::where('kriteria', 'Wawasan')
            ->where('subkriteria', $wawasan)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_komitmen($komitmen){
        if (in_array($komitmen, ['1', '2', '3', '4', '5'])) {
            $hasil = subkriteria::where('kriteria', 'Komitmen')
            ->where('subkriteria', $komitmen)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_fairness($fairness){
        if (in_array($fairness, ['1', '2', '3', '4', '5'])) {
            $hasil = subkriteria::where('kriteria', 'Fairness')
            ->where('subkriteria', $fairness)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_teamwork($teamwork){
        if (in_array($teamwork, ['1', '2', '3', '4', '5'])) {
            $hasil = subkriteria::where('kriteria', 'Teamwork')
            ->where('subkriteria', $teamwork)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_potensi($potensi){
        if (in_array($potensi, ['1', '2', '3', '4', '5'])) {
            $hasil = subkriteria::where('kriteria', 'Potensi Diri')
            ->where('subkriteria', $potensi)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_analisis($analisis){
        if (in_array($analisis, ['1', '2', '3', '4', '5'])) {
            $hasil = subkriteria::where('kriteria', 'Daya Analisis')
            ->where('subkriteria', $analisis)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_technical($technical){
        if (in_array($technical, ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'])) {
            $hasil = subkriteria::where('kriteria', 'Technical Divisi')
            ->where('subkriteria', $technical)
            ->value('nilai') ?? 0;
            return $hasil;
        } else {
            return 0;
        }    
    }
    public function cek_portofolio($portofolio,$jmlBaris){
        if ($portofolio == null ) {
            $hasil= subkriteria::where('kriteria', 'Portofolio')
                                    ->where('subkriteria', '0')->value('nilai');
                                    return $hasil;
        }elseif($portofolio !== null && $jmlBaris==1){
            $hasil= subkriteria::where('kriteria', 'Portofolio')
                                    ->where('subkriteria', '1')->value('nilai');
                                    return $hasil;
        } elseif($portofolio !== null && $jmlBaris==2){
            $hasil= subkriteria::where('kriteria', 'Portofolio')
                                    ->where('subkriteria', '2')->value('nilai');
                                    return $hasil;
        }elseif($portofolio !== null && $jmlBaris>2){
            $hasil= subkriteria::where('kriteria', 'Portofolio')
                                    ->where('subkriteria', '>2')->value('nilai');
                                    return $hasil;
        }else{
            $hasil = 0;
            return $hasil;
        }
    }
    public function utilitas(){
        $baris = nilai_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->get();
        foreach($baris as $item){
            $nim = $item->nim;
            $nama = $item->nama;
            $lab = $item->lab;
            $nilai_algo1 = $item->algo1;
            $nilai_pbo = $item->pbo;
            $nilai_sql = $item->sql;
            $nilai_pweb = $item->pweb;
            $nilai_paa = $item->paa;
            $nilai_uiux = $item->uiux;
            $nilai_ood = $item->ood;
            $nilai_algo2 = $item->algo2;
            $nilai_pmobile = $item->pmobile;
            $nilai_sbd = $item->sbd;
            $nilai_tkti = $item->tkti;
            $nilai_adpl = $item->adpl;
            $nilai_mpti = $item->mpti;
            $nilai_ppla = $item->ppla;
            $nilai_visi= $item->visi;
            $nilai_wawasan = $item->wawasan;
            $nilai_komitmen = $item->komitmen;
            $nilai_fairness = $item->fairness;
            $nilai_teamwork = $item->teamwork;
            $nilai_potensi = $item->potensi;
            $nilai_analisis = $item->analisis;
            $nilai_technical = $item->technical;
            $nilai_portofolio = $item->portofolio;
            $this->rumus_uti(
                $nim,$nama, $nilai_algo1, $nilai_pbo, $nilai_sql, $nilai_ppla, $nilai_pweb, 
                $nilai_paa, $nilai_uiux, $nilai_ood,$lab,$nilai_algo2,$nilai_pmobile,$nilai_sbd,
                $nilai_tkti, $nilai_adpl, $nilai_mpti, $nilai_visi, $nilai_wawasan, $nilai_komitmen, 
                $nilai_fairness, $nilai_teamwork, $nilai_potensi, $nilai_analisis, $nilai_technical, $nilai_portofolio
            );
        }
        return 'isert data berhasil';
    }
    public function rumus_uti(
        $nim,$nama, $nilai_algo1, $nilai_pbo, $nilai_sql, $nilai_ppla, $nilai_pweb, 
        $nilai_paa, $nilai_uiux, $nilai_ood,$lab,$nilai_algo2,$nilai_pmobile,$nilai_sbd,
        $nilai_tkti, $nilai_adpl, $nilai_mpti, $nilai_visi, $nilai_wawasan, $nilai_komitmen, 
        $nilai_fairness, $nilai_teamwork, $nilai_potensi, $nilai_analisis, $nilai_technical, $nilai_portofolio
    ){
        $minMaxValues = [
            'min_algo1' => nilai_rpl::where('lab', $lab)->min('algo1'),
            'max_algo1' => nilai_rpl::where('lab', $lab)->max('algo1'),
            'min_pbo' => nilai_rpl::where('lab', $lab)->min('pbo'),
            'max_pbo' => nilai_rpl::where('lab', $lab)->max('pbo'),
            'min_sql' => nilai_rpl::where('lab', $lab)->min('sql'),
            'max_sql' => nilai_rpl::where('lab', $lab)->max('sql'),
            'min_pweb' => nilai_rpl::where('lab', $lab)->min('pweb'),
            'max_pweb' => nilai_rpl::where('lab', $lab)->max('pweb'),
            'min_paa' => nilai_rpl::where('lab', $lab)->min('paa'),
            'max_paa' => nilai_rpl::where('lab', $lab)->max('paa'),
            'min_uiux' => nilai_rpl::where('lab', $lab)->min('uiux'),
            'max_uiux' => nilai_rpl::where('lab', $lab)->max('uiux'),
            'min_ood' => nilai_rpl::where('lab', $lab)->min('ood'),
            'max_ood' => nilai_rpl::where('lab', $lab)->max('ood'),
            'min_algo2' => nilai_rpl::where('lab', $lab)->min('algo2'),
            'max_algo2' => nilai_rpl::where('lab', $lab)->max('algo2'),
            'min_pmobile' => nilai_rpl::where('lab', $lab)->min('pmobile'),
            'max_pmobile' => nilai_rpl::where('lab', $lab)->max('pmobile'),
            'min_sbd' => nilai_rpl::where('lab', $lab)->min('sbd'),
            'max_sbd' => nilai_rpl::where('lab', $lab)->max('sbd'),
            'min_tkti' => nilai_rpl::where('lab', $lab)->min('tkti'),
            'max_tkti' => nilai_rpl::where('lab', $lab)->max('tkti'),
            'min_adpl' => nilai_rpl::where('lab', $lab)->min('adpl'),
            'max_adpl' => nilai_rpl::where('lab', $lab)->max('adpl'),
            'min_mpti' => nilai_rpl::where('lab', $lab)->min('mpti'),
            'max_mpti' => nilai_rpl::where('lab', $lab)->max('mpti'),
            'min_ppla' => nilai_rpl::where('lab', $lab)->min('ppla'),
            'max_ppla' => nilai_rpl::where('lab', $lab)->max('ppla'),
            'min_visi' => nilai_rpl::where('lab', $lab)->min('visi'),
            'max_visi' => nilai_rpl::where('lab', $lab)->max('visi'),
            'min_wawasan' => nilai_rpl::where('lab', $lab)->min('wawasan'),
            'max_wawasan' => nilai_rpl::where('lab', $lab)->max('wawasan'),
            'min_komitmen' => nilai_rpl::where('lab', $lab)->min('komitmen'),
            'max_komitmen' => nilai_rpl::where('lab', $lab)->max('komitmen'),
            'min_fairness' => nilai_rpl::where('lab', $lab)->min('fairness'),
            'max_fairness' => nilai_rpl::where('lab', $lab)->max('fairness'),
            'min_teamwork' => nilai_rpl::where('lab', $lab)->min('teamwork'),
            'max_teamwork' => nilai_rpl::where('lab', $lab)->max('teamwork'),
            'min_potensi' => nilai_rpl::where('lab', $lab)->min('potensi'),
            'max_potensi' => nilai_rpl::where('lab', $lab)->max('potensi'),
            'min_analisis' => nilai_rpl::where('lab', $lab)->min('analisis'),
            'max_analisis' => nilai_rpl::where('lab', $lab)->max('analisis'),
            'min_technical' => nilai_rpl::where('lab', $lab)->min('technical'),
            'max_technical' => nilai_rpl::where('lab', $lab)->max('technical'),
            'min_portofolio' => nilai_rpl::where('lab', $lab)->min('portofolio'),
            'max_portofolio' => nilai_rpl::where('lab', $lab)->max('portofolio'),
        ];
        
        if ($minMaxValues) {
            // Extract min and max values for each column
            $min_algo1 = $minMaxValues['min_algo1'];
            $max_algo1 = $minMaxValues['max_algo1'];
            $min_pbo = $minMaxValues['min_pbo'];
            $max_pbo = $minMaxValues['max_pbo'];
            $min_sql = $minMaxValues['min_sql'];
            $max_sql = $minMaxValues['max_sql'];
            $min_pweb = $minMaxValues['min_pweb'];
            $max_pweb = $minMaxValues['max_pweb'];
            $min_paa = $minMaxValues['min_paa'];
            $max_paa = $minMaxValues['max_paa'];
            $min_uiux = $minMaxValues['min_uiux'];
            $max_uiux = $minMaxValues['max_uiux'];
            $min_ood = $minMaxValues['min_ood'];
            $max_ood = $minMaxValues['max_ood'];
            $min_algo2 = $minMaxValues['min_algo2'];
            $max_algo2 = $minMaxValues['max_algo2'];
            $min_pmobile = $minMaxValues['min_pmobile'];
            $max_pmobile = $minMaxValues['max_pmobile'];
            $min_sbd = $minMaxValues['min_sbd'];
            $max_sbd = $minMaxValues['max_sbd'];
            $min_tkti = $minMaxValues['min_tkti'];
            $max_tkti = $minMaxValues['max_tkti'];
            $min_adpl = $minMaxValues['min_adpl'];
            $max_adpl = $minMaxValues['max_adpl'];
            $min_mpti = $minMaxValues['min_mpti'];
            $max_mpti = $minMaxValues['max_mpti'];
            $min_ppla = $minMaxValues['min_ppla'];
            $max_ppla = $minMaxValues['max_ppla'];
            $min_visi = $minMaxValues['min_visi'];
            $max_visi = $minMaxValues['max_visi'];
            $min_wawasan = $minMaxValues['min_wawasan'];
            $max_wawasan = $minMaxValues['max_wawasan'];
            $min_komitmen = $minMaxValues['min_komitmen'];
            $max_komitmen = $minMaxValues['max_komitmen'];
            $min_fairness = $minMaxValues['min_fairness'];
            $max_fairness = $minMaxValues['max_fairness'];
            $min_teamwork = $minMaxValues['min_teamwork'];
            $max_teamwork = $minMaxValues['max_teamwork'];
            $min_potensi = $minMaxValues['min_potensi'];
            $max_potensi = $minMaxValues['max_potensi'];
            $min_analisis = $minMaxValues['min_analisis'];
            $max_analisis = $minMaxValues['max_analisis'];
            $min_technical = $minMaxValues['min_technical'];
            $max_technical = $minMaxValues['max_technical'];
            $min_portofolio = $minMaxValues['min_portofolio'];
            $max_portofolio = $minMaxValues['max_portofolio'];                        // Extract min and max values for other columns similarly

            $uti_algo1 = ($max_algo1 != $min_algo1) ? ($nilai_algo1 - $min_algo1) / ($max_algo1 - $min_algo1) : 0;
            $uti_pbo = ($max_pbo != $min_pbo) ? ($nilai_pbo - $min_pbo) / ($max_pbo - $min_pbo) : 0;
            $uti_sql = ($max_sql != $min_sql) ? ($nilai_sql - $min_sql) / ($max_sql - $min_sql) : 0;
            $uti_pweb = ($max_pweb != $min_pweb) ? ($nilai_pweb - $min_pweb) / ($max_pweb - $min_pweb) : 0;
            $uti_paa = ($max_paa != $min_paa) ? ($nilai_paa - $min_paa) / ($max_paa - $min_paa) : 0;
            $uti_uiux = ($max_uiux != $min_uiux) ? ($nilai_uiux - $min_uiux) / ($max_uiux - $min_uiux) : 0;
            $uti_ood = ($max_ood != $min_ood) ? ($nilai_ood - $min_ood) / ($max_ood - $min_ood) : 0;
            $uti_algo2 = ($max_algo2 != $min_algo2) ? ($nilai_algo2 - $min_algo2) / ($max_algo2 - $min_algo2) : 0;
            $uti_pmobile = ($max_pmobile != $min_pmobile) ? ($nilai_pmobile - $min_pmobile) / ($max_pmobile - $min_pmobile) : 0;
            $uti_sbd = ($max_sbd != $min_sbd) ? ($nilai_sbd - $min_sbd) / ($max_sbd - $min_sbd) : 0;
            $uti_tkti = ($max_tkti != $min_tkti) ? ($nilai_tkti - $min_tkti) / ($max_tkti - $min_tkti) : 0;
            $uti_adpl = ($max_adpl != $min_adpl) ? ($nilai_adpl - $min_adpl) / ($max_adpl - $min_adpl) : 0;
            $uti_mpti = ($max_mpti != $min_mpti) ? ($nilai_mpti - $min_mpti) / ($max_mpti - $min_mpti) : 0;
            $uti_ppla = ($max_ppla != $min_ppla) ? ($nilai_ppla - $min_ppla) / ($max_ppla - $min_ppla) : 0;
            $uti_visi = ($max_visi != $min_visi) ? ($nilai_visi - $min_visi) / ($max_visi - $min_visi) : 0;
            $uti_wawasan = ($max_wawasan != $min_wawasan) ? ($nilai_wawasan - $min_wawasan) / ($max_wawasan - $min_wawasan) : 0;
            $uti_komitmen = ($max_komitmen != $min_komitmen) ? ($nilai_komitmen - $min_komitmen) / ($max_komitmen - $min_komitmen) : 0;
            $uti_fairness = ($max_fairness != $min_fairness) ? ($nilai_fairness - $min_fairness) / ($max_fairness - $min_fairness) : 0;
            $uti_teamwork = ($max_teamwork != $min_teamwork) ? ($nilai_teamwork - $min_teamwork) / ($max_teamwork - $min_teamwork) : 0;
            $uti_potensi = ($max_potensi != $min_potensi) ? ($nilai_potensi - $min_potensi) / ($max_potensi - $min_potensi) : 0;
            $uti_analisis = ($max_analisis != $min_analisis) ? ($nilai_analisis - $min_analisis) / ($max_analisis - $min_analisis) : 0;
            $uti_technical = ($max_technical != $min_technical) ? ($nilai_technical - $min_technical) / ($max_technical - $min_technical) : 0;
            $uti_portofolio = ($max_portofolio != $min_portofolio) ? ($nilai_portofolio - $min_portofolio) / ($max_portofolio - $min_portofolio) : 0;
                        
            // Calculate the normalized values for other columns similarly
            $existingRecord = uti_rpl::where('nama', $nama)->first();
            $data = [
                'nama' => $nama,
                'nim' => $nim,
                'lab' => $lab,
                'algo1' => $uti_algo1,
                'pbo' => $uti_pbo,
                'sql' => $uti_sql,
                'pweb' => $uti_pweb,
                'paa' => $uti_paa,
                'uiux' => $uti_uiux,
                'ood' => $uti_ood,
                'algo2' => $uti_algo2,
                'pmobile' => $uti_pmobile,
                'sbd' => $uti_sbd,
                'tkti' => $uti_tkti,
                'adpl' => $uti_adpl,
                'mpti' => $uti_mpti,
                'ppla' => $uti_ppla,
                'visi' => $uti_visi,
                'wawasan' => $uti_wawasan,
                'komitmen' => $uti_komitmen,
                'fairness' => $uti_fairness,
                'teamwork' => $uti_teamwork,
                'potensi' => $uti_potensi,
                'analisis' => $uti_analisis,
                'technical' => $uti_technical,
                'portofolio' => $uti_portofolio,
            ];
            
            if(!$existingRecord){
                    uti_rpl::create($data);
            }else{
                $existingRecord->update($data);
            }
        } else {
        }
    }
    public function nilai_akhir(){
        $norm_visi = normalisasi::where('norm_kriteria', 'Visi')
                            ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_analisis = normalisasi::where('norm_kriteria', 'Daya Analisis')
                                        ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_fairness = normalisasi::where('norm_kriteria', 'Fairness')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_komitmen = normalisasi::where('norm_kriteria', 'Komitmen')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_matkul = normalisasi::where('norm_kriteria', 'Nilai Mata Kuliah (RPL)')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_portofolio = normalisasi::where('norm_kriteria', 'Portofolio')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_potensi = normalisasi::where('norm_kriteria', 'Potensi Diri')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_teamwork = normalisasi::where('norm_kriteria', 'Teamwork')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_technical = normalisasi::where('norm_kriteria', 'Technical Divisi')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');
        $norm_wawasan = normalisasi::where('norm_kriteria', 'Wawasan')
                                    ->where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('normalisasi');



        $data = uti_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->get();
        foreach($data as $item2){
            $nama = $item2->nama;
            $nim = $item2->nim;
            $lab = $item2->lab;
            $algo1 = $item2->algo1;
            $na_algo = $algo1 * $norm_matkul;
            $pbo = $item2->pbo;
            $na_pbo = $pbo * $norm_matkul;
            $sql = $item2->sql;
            $na_sql = $sql * $norm_matkul;
            $pweb = $item2->pweb;
            $na_pweb = $pweb * $norm_matkul;
            $paa = $item2->paa;
            $na_paa = $paa * $norm_matkul;
            $uiux = $item2->uiux;
            $na_uiux = $uiux * $norm_matkul;
            $ood = $item2->ood;
            $na_ood = $ood * $norm_matkul;
            $algo2 = $item2->algo2;
            $na_algo2 = $algo2 * $norm_matkul;
            $pmobile = $item2->pmobile;
            $na_pmobile = $pmobile * $norm_matkul;
            $sbd = $item2->sbd;
            $na_sbd = $sbd * $norm_matkul;
            $tkti = $item2->tkti;
            $na_tkti = $tkti * $norm_matkul;
            $adpl = $item2->adpl;
            $na_adpl = $adpl * $norm_matkul;
            $mpti = $item2->mpti;
            $na_mpti = $mpti * $norm_matkul;
            $ppla = $item2->ppla;
            $na_ppla = $ppla * $norm_matkul;
            $visi = $item2->visi;
            $na_visi = $visi * $norm_visi;
            $wawasan = $item2->wawasan;
            $na_wawasan = $wawasan * $norm_wawasan;
            $komitmen = $item2->komitmen;
            $na_komitmen = $komitmen * $norm_komitmen;
            $fairness = $item2->fairness;
            $na_fairness = $fairness * $norm_fairness;
            $teamwork = $item2->teamwork;
            $na_teamwork = $teamwork * $norm_teamwork;
            $potensi = $item2->potensi;
            $na_potensi = $potensi * $norm_potensi;
            $analisis = $item2->analisis;
            $na_analisis = $analisis * $norm_analisis;
            $technical = $item2->technical;
            $na_technical = $technical * $norm_technical;
            $portofolio = $item2->portofolio;
            $na_portofolio = $portofolio * $norm_portofolio;


            $total = $na_algo + $na_pbo + $na_sql + $na_pweb + $na_paa + $na_uiux + $na_ood + $na_algo2 + $na_pmobile + $na_sbd + $na_tkti + $na_adpl + $na_mpti + $na_ppla + $na_visi + $na_wawasan + $na_komitmen + $na_fairness + $na_teamwork + $na_potensi + $na_analisis + $na_technical + $na_portofolio;

            
            $existingRecord = nilaiakhir_rpl::where('nama', $nama)->first();
            $data = [
                'nama' => $nama,
                'nim' => $nim,
                'lab' => $lab,
                'algo1' => $na_algo,
                'pbo' => $na_pbo,
                'sql' => $na_sql,
                'pweb' => $na_pweb,
                'paa' => $na_paa,
                'uiux' => $na_uiux,
                'ood' => $na_ood,
                'algo2' => $na_algo2,
                'pmobile' => $na_pmobile,
                'sbd' => $na_sbd,
                'tkti' => $na_tkti,
                'adpl' => $na_adpl,
                'mpti' => $na_mpti,
                'ppla' => $na_ppla,
                'visi' => $na_visi,
                'wawasan' => $na_wawasan,
                'komitmen' => $na_komitmen,
                'fairness' => $na_fairness,
                'teamwork' => $na_teamwork,
                'potensi' => $na_potensi,
                'analisis' => $na_analisis,
                'technical' => $na_technical,
                'portofolio' => $na_portofolio,
                'total' => $total
            ];
            if(!$existingRecord){
                nilaiakhir_rpl::create($data);
            }elseif($existingRecord){
                $existingRecord->update($data);
            }else{
                return 'gagal menambah data';
            }
            
            // $j+=1;
        }
    }

    public function testrpl(){
        $data = data_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->get();
        $da_lab = data_rpl::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('lab');
        // $da_kom = data_alternatif::where('da_lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('ai_komunikasi_kerja');
        // $da_ide = data_alternatif::where('da_lab', 'Laboratorium Rekayasa Perangkat Lunak')->value('ide_project');
        
        $processedNames = [];
        $result = [];
        foreach($data as $item){
            $nama = $item->nama;
            $nim = $item->nim;
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
            $portofolio = $item->detail_porto;
            $nilai_portofolio = $this->cek_portofolio($portofolio, $jmlBaris);
            $result[] = $nama.' '.$nilai_portofolio;


            // $existingRecord = nilai_rpl::where('nama',$nama)->where('lab', $lab)->first();
            // $data = [
            //     'nim' => $nim,
            //     'nama'=>$nama,
            //     'lab'=>$lab,
            //     'algo1'=>$nilai_algo1,
            //     'pbo'=>$nilai_pbo,
            //     'sql'=>$nilai_sql,
            //     'pweb'=>$nilai_pweb,
            //     'paa'=>$nilai_paa,
            //     'uiux'=>$nilai_uiux,
            //     'ood'=>$nilai_ood,
            //     'algo2'=>$nilai_algo2,
            //     'pmobile'=>$nilai_pmobile,
            //     'sbd'=>$nilai_sbd,
            //     'tkti'=>$nilai_tkti,
            //     'adpl'=>$nilai_adpl,
            //     'mpti'=>$nilai_mpti,
            //     'ppla'=>$nilai_ppla,
            //     'visi'=>$nilai_visi,
            //     'wawasan'=>$nilai_wawasan,
            //     'komitmen'=>$nilai_komitmen,
            //     'fairness'=>$nilai_fairness,
            //     'teamwork'=>$nilai_teamwork,
            //     'potensi'=>$nilai_potensi,
            //     'analisis'=>$nilai_analisis,
            //     'technical'=>$nilai_technical,
            //     'portofolio'=>$nilai_portofolio,        
            // ];

            // if(!$existingRecord){
            //     nilai_rpl::create($data);
            //     // return 'insert data berhasil';
            // }elseif($existingRecord){
            //     $existingRecord->update($data);
            // }
        }
        return $result;
    }








}
