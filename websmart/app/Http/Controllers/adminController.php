<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\data_alternatif;
use App\Models\kriteria;
use App\Models\lab;
use App\Models\nilai_akhir;
use App\Models\nilai_alternatif;
use App\Models\normalisasi;
use App\Models\subkriteria;
use App\Models\utilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function kriteria(Request $request){
        $katakunci = $request->katakunci;
        $nama_lab = Lab::distinct('nama_lab')->pluck('nama_lab');
        $jumlahbaris = 10;
        if (strlen($katakunci)) {
            $data = kriteria::where('kriteria', 'like', '%' . $katakunci . '%')
                        ->orWhere('bobot', 'like', '%' . $katakunci . '%')
                        ->paginate($jumlahbaris);
        } else {
            $data = kriteria::paginate($jumlahbaris);
            $data_lab_pc = kriteria::where('lab', 'Laboratorium Pertanian Cerdas')->paginate($jumlahbaris);
            $data_lab_ai = kriteria::where('lab', 'Laboratorium Artificial Intelligence')->paginate($jumlahbaris);
            $data_lab_it = kriteria::where('lab', 'Laboratorium Infrastruktur Teknologi')->paginate($jumlahbaris);

        }

        return view('admin.kriteria', [
            'data' => $data,
            'nama_lab' => $nama_lab,
            'data_lab_pc' => $data_lab_pc,
            'data_lab_ai' => $data_lab_ai,
            'data_lab_it' => $data_lab_it,
        ]);
    }

    public function subkriteria(Request $request){
        // Fetch distinct values from the 'kriteria' column
        $krit_pc = Kriteria::where('lab', 'Laboratorium Pertanian Cerdas')->pluck('kriteria');
        $krit_ai = Kriteria::where('lab', 'Laboratorium Artificial Intelligence')->pluck('kriteria');
        $krit_it = Kriteria::where('lab', 'Laboratorium Infrastruktur Teknologi')->pluck('kriteria');
        $subkriteria = $request->input('subkriteria');

        // Fetch paginated results from the 'subkriteria' model
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;

        if (strlen($katakunci)) {
            $data = Subkriteria::where('kriteria', 'like', '%' . $katakunci . '%')
                ->orWhere('subkriteria', 'like', '%' . $katakunci . '%')
                ->orWhere('nilai', 'like', '%' . $katakunci . '%')
                ->paginate($jumlahbaris);
        } else {
            $data = Subkriteria::paginate($jumlahbaris);
            $data_lab_pc = subkriteria::where('s_lab', 'Laboratorium Pertanian Cerdas')->paginate($jumlahbaris);
            $data_lab_ai = subkriteria::where('s_lab', 'Laboratorium Artificial Intelligence')->paginate($jumlahbaris);
            $data_lab_it = subkriteria::where('s_lab', 'Laboratorium Infrastruktur Teknologi')->paginate($jumlahbaris);
        }
        return view('admin.subkriteria', [
            'data' => $data, 
            'subkriteria'=>$subkriteria, 
            'krit_pc' => $krit_pc,
            'krit_ai' => $krit_ai,
            'krit_it' => $krit_it,
            'data_lab_pc' => $data_lab_pc,
            'data_lab_ai' => $data_lab_ai,
            'data_lab_it' => $data_lab_it,

        ]);
    }

    public function index(){
        return view('admin.dashboard');
    }

    public function alternatif(Request $request){
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;

        if (strlen($katakunci)) {
            $data = alternatif::where('nim', 'like', '%' . $katakunci . '%')
                        ->orWhere('nama', 'like', '%' . $katakunci . '%')
                        ->orWhere('prodi', 'like', '%' . $katakunci . '%')
                        ->paginate($jumlahbaris);
        } else {
            $data = alternatif::paginate($jumlahbaris);
            $data_calon = data_alternatif::paginate($jumlahbaris);
            $data_lab_pc = data_alternatif::where('da_lab', 'Laboratorium Pertanian Cerdas')->paginate($jumlahbaris);
            $data_lab_ai = data_alternatif::where('da_lab', 'Laboratorium Artificial Intelligence')->paginate($jumlahbaris);
            $data_lab_it = data_alternatif::where('da_lab', 'Laboratorium Infrastruktur Teknologi')->paginate($jumlahbaris);

        }
        return view('admin.alternatif', [
            'data' => $data, 
            'data_calon' => $data_calon,
            'data_lab_pc' => $data_lab_pc,
            'data_lab_ai' => $data_lab_ai,
            'data_lab_it' => $data_lab_it
        ]);
        
        // return view('admin.alternatif');
    }

    public function showpdf_sertifprestasi($id)
    {
        $pdf = data_alternatif::findOrFail($id);
        $filePath = storage_path('app/' . $pdf->da_sertif_prestasi);

        return response()->file($filePath);
    }

    public function showpdf_sertiforganisasi($id)
    {
        $pdf = data_alternatif::findOrFail($id);
        $filePath = storage_path('app/' . $pdf->da_sertif_organisasi);

        return response()->file($filePath);
    }

    public function showpdf_khs($id)
    {
        $pdf = data_alternatif::findOrFail($id);
        $filePath = storage_path('app/' . $pdf->khs);

        return response()->file($filePath);
    }

    public function nilai(){
        $data = alternatif::distinct('nama')->pluck('nama');
        return view('admin.nilai', ['data' => $data]);
    }

    public function spk(){
        $data = normalisasi::all();
        return view('admin.spk', ['data'=>$data]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $request->validate([
            'nim'=>'required|numeric|unique:tb_alternatif,nim',
            'nama'=>'required',
            'prodi'=>'required',
            'ipk'=>'required',
        ],[
            'nim.required'=>'NIM wajib diisi',
            'nim.numeric'=>'NIM wajib dalam angka',
            'nim.unique'=>'NIM tidak boleh sama',
            'nama.required'=>'Nama wajib diisi',
            'prodi.required'=>'Program Studi wajib diisi',
            'ipk.required'=>'IPK wajib diisi',
        ]);
        $data = [
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'prodi'=>$request->prodi,
            'ipk'=>$request->ipk,
        ];
        alternatif::create($data);
        return redirect()->route('alternatif')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $alternatifData = alternatif::where('nama',$id)->first();
        $distinct_nama_lab = Lab::distinct('nama_lab')->pluck('nama_lab');
        return redirect()->route('showform',['alternatifData' => $alternatifData, 'distinct_nama_lab' => $distinct_nama_lab]);
    }

    public function edit_da($id){
        $data2 = data_alternatif::where('da_nim',$id)->first();
        $distinct_nama_lab = Lab::distinct('nama_lab')->pluck('nama_lab');
        return view('admin.editalternatif',['data2' => $data2, 'distinct_nama_lab' => $distinct_nama_lab]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(Auth::check() && Auth::user()->name === 'aslab ai'){

        $data = [
            'da_nilai_wawancara'=>$request->nilai_wawancara,
        ];
        $exist = data_alternatif::where('da_nim', $id)->get();
        if(!$exist){
            data_alternatif::create($data);
            return redirect()->route('alternatif')->with('success', 'Data Berhasil Ditambahkan!');
        }elseif($exist){
            data_alternatif::where('da_nim', $id)->update($data);
            return redirect()->route('alternatif')->with('success', 'Data Berhasil Diupdate!');
        }
        return redirect()->route('alternatif')->with('error', 'Data Sudah Ada');
    }elseif(Auth::check() && Auth::user()->name === 'aslab pc'){
        $data = [
            'da_nilai_wawancara'=>$request->nilai_wawancara,
            'da_nilai_tulis'=>$request->nilai_tulis,
        ];
        $exist = data_alternatif::where('da_nim', $id)->get();
        if(!$exist){
            data_alternatif::create($data);
            return redirect()->route('alternatif')->with('success', 'Data Berhasil Ditambahkan!');
        }elseif($exist){
            data_alternatif::where('da_nim', $id)->update($data);
            return redirect()->route('alternatif')->with('success', 'Data Berhasil Diupdate!');
        }
        return redirect()->route('alternatif')->with('error', 'Data Sudah Ada');
    }elseif(Auth::check() && Auth::user()->name === 'aslab it'){
        $data = [
            'itnilai_mengajar'=>$request->itnilai_mengajar,
            'itnilai_probsolv'=>$request->itnilai_probsolv,
            'itnilai_timemj'=>$request->itnilai_timemj,
            'da_nilai_tulis' => $request->nilai_tulis
        ];
        $exist = data_alternatif::where('da_nim', $id)->get();
        if(!$exist){
            data_alternatif::create($data);
            return redirect()->route('alternatif')->with('success', 'Data Berhasil Ditambahkan!');
        }elseif($exist){
            data_alternatif::where('da_nim', $id)->update($data);
            return redirect()->route('alternatif')->with('success', 'Data Berhasil Diupdate!');
        }
        return redirect()->route('alternatif')->with('error', 'Data Sudah Ada');

    }
        
    }

    public function del_calon($id){
        data_alternatif::where('da_nama',$id)->delete();
        nilai_alternatif::where('nama',$id)->delete();
        utilitas::where('nama',$id)->delete();
        nilai_akhir::where('nama',$id)->delete();
        return redirect()->route('alternatif')->with('success', 'Data Berhasil dihapus!');
    }
    
    public function storeKriteria(Request $request){
        $request->validate([
            'kriteria'=>'required',
            'bobot'=>'required|numeric',
            'lab'=>'required'
        ],[
            'kriteria.required'=>'Kriteria wajib diisi',
            'bobot.required'=>'Bobot wajib diisi',
            'bobot.numeric'=>'Bobot harus dalam angka',
            'lab.required'=>'Laboratorium wajib diisi'
        ]);
        $data = [
            'kriteria'=>$request->kriteria,
            'bobot'=>$request->bobot,
            'lab'=>$request->lab
        ];
        kriteria::create($data);
        return redirect()->route('kriteria')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * @param string $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit_kriteria($id){
        $data = kriteria::where('kriteria',$id)->first();
        return view('admin.editkriteria',['data' => $data]);
    }

    public function update_kriteria(Request $request, $id){
        $request->validate([
            'bobot'=>'required|numeric',
        ],[
            'bobot.required'=>'Bobot wajib diisi',
            'bobot.numeric'=>'Bobot harus dalam angka'
        ]);
        $data = [
            'kriteria'=>$request->kriteria,
            'bobot'=>$request->bobot,
            'lab'=>$request->lab
        ];
        kriteria::where('kriteria',$id)->update($data);
        return redirect()->route('kriteria')->with('success', 'Data Berhasil Diupdate!');
    }

    public function del_kriteria($id){
        kriteria::where('kriteria',$id)->delete();
        return redirect()->route('kriteria')->with('success', 'Data Berhasil dihapus!');
    }

    public function store_sub(Request $request){
        // $distinct_kriteria = Kriteria::distinct('kriteria')->pluck('kriteria');
        // $subkriteria = $request->input('subkriteria');
        $s_lab = kriteria::where('kriteria', $request->kriteria)->value('lab');
        $request->validate([
            'kriteria'=>'required',
            'subkriteria'=>'required',
            'nilai'=>'required|numeric'
        ],[
            'kriteria.required'=>'Kriteria wajib diisi',
            'subkriteria.required'=>'Subkriteria wajib diisi',
            'nilai.required'=>'nilai wajib diisi',
            'nilai.numeric'=>'nilai harus dalam angka'
        ]);
        $data = [
            'kriteria'=>$request->kriteria,
            'subkriteria'=>$request->subkriteria,
            'nilai'=>$request->nilai,
            's_lab'=>$s_lab
        ];
        subkriteria::create($data);
        // return view('admin.subkriteria', ['subkriteria'=>$subkriteria, 'distinct_kriteria'=>$distinct_kriteria])->with('success', 'Data Berhasil Ditambahkan!');
        return redirect()->route('subkriteria')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit_sub($id){
        $data = subkriteria::where('id',$id)->first();
        return view('admin.editsub', ['data' => $data]);
        
    }

    public function update_sub(Request $request, $id){
        $request->validate([
            'kriteria'=>'required',
            'subkriteria'=>'required',
            'nilai'=>'required|numeric'
        ],[
            'kriteria.required'=>'Kriteria wajib diisi',
            'subkriteria.required'=>'Subkriteria wajib diisi',
            'nilai.required'=>'nilai wajib diisi',
            'nilai.numeric'=>'nilai harus dalam angka'
        ]);
        $lab = subkriteria::where('kriteria', $request->kriteria)->where('subkriteria',$id)->value('s_lab');
        $data = [
            'kriteria'=>$request->kriteria,
            'subkriteria'=>$request->subkriteria,
            'nilai'=>$request->nilai,
            's_lab'=>$lab
        ];
        subkriteria::where('subkriteria',$id)->update($data);
        return redirect()->route('subkriteria')->with('success', 'Data Berhasil Diupdate!');
    }

    public function del_sub($id){
        subkriteria::where('subkriteria',$id)->delete();
        return redirect()->route('subkriteria')->with('success', 'Data Berhasil dihapus!');
    }

    public function update_status(Request $request, $id)
    {
        $data = data_alternatif::where('da_nama', $id)->get();
        $data->status = $request->input('status');
        $data2 = [
            'status'=>$data->status
        ];
        data_alternatif::where('da_nama', $id)->update($data2);

        return redirect()->route('alternatif')->with('success', 'Data Berhasil Diupdate!');
    }

    public function store_nilai(Request $request){
        //KOK MANUAL??
        
        // $request->validate([
        //     'nama'=>'required',
        //     'nilai_ipk'=>'required|numeric',
        //     'nilai_sertif_prestasi'=>'required|numeric',
        //     'nilai_sertif_organisasi'=>'required|numeric',
        //     'nilai_tulis'=>'required|numeric',
        //     'nilai_wawancara'=>'required|numeric',
        //     'nilai_matkul'=>'required|numeric',
        // ],[
        //     'nama.required'=>'Nama wajib diisi',
        //     'nilai_ipk.required'=>'nilai_ipk wajib diisi',
        //     'nilai_ipk.numeric'=>'nilai harus dalam angka',
        //     'nilai_sertif_prestasi.required'=>'nilai sertif prestasi wajib diisi',
        //     'nilai_sertif_prestasi.numeric'=>'nilai sertif prestasi harus dalam angka',
        //     'nilai_sertif_organisasi.required'=>'nilai sertif organisasi wajib diisi',
        //     'nilai_sertif_organisasi.numeric'=>'nilai harus dalam angka',
        //     'nilai_tulis.required'=>'nilai_ipk wajib diisi',
        //     'nilai_tulis.numeric'=>'nilai harus dalam angka',
        //     'nilai_wawancara.required'=>'nilai_ipk wajib diisi',
        //     'nilai_wawancara.numeric'=>'nilai harus dalam angka',
        //     'nilai_matkul.required'=>'nilai_ipk wajib diisi',
        //     'nilai_matkul.numeric'=>'nilai harus dalam angka',
        // ]);
        // $data = [
        //     'kriteria'=>$request->kriteria,
        //     'subkriteria'=>$request->subkriteria,
        //     'nilai'=>$request->nilai
        // ];
        // subkriteria::create($data);
        // return redirect()->route('subkriteria')->with('success', 'Data Berhasil Ditambahkan!');
    }
}