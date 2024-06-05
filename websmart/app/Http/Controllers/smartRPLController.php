<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\nilai_akhir;
use App\Models\nilai_alternatif;
use App\Models\normalisasi;
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
        $na = nilai_akhir::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);
        $data = normalisasi::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);
        $nilai_alt = nilai_alternatif::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);
        $uti = utilitas::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')->paginate($jumlahbaris);



        $final = 0;
        $rank = [];
        $result = [];
        $hasil = [];
        $nilai = nilai_akhir::all(); // Fetch all rows from the table
        $total = nilai_akhir::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')
            ->orderBy('total', 'desc')
            ->get();

        $cmin = nilai_alternatif::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')
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
        $cmax = nilai_alternatif::where('lab', 'Laboratorium Rekayasa Perangkat Lunak')
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

}
