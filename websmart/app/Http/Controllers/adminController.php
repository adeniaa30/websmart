<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\data_alternatif;
use App\Models\kriteria;
use App\Models\subkriteria;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function kriteria(Request $request){
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if (strlen($katakunci)) {
            $data = kriteria::where('kriteria', 'like', '%' . $katakunci . '%')
                        ->orWhere('bobot', 'like', '%' . $katakunci . '%')
                        ->paginate($jumlahbaris);
        } else {
            $data = kriteria::paginate($jumlahbaris);
        }

        return view('admin.kriteria', ['data' => $data]);
    }

    public function subkriteria(Request $request){
        // Fetch distinct values from the 'kriteria' column
        $distinct_kriteria = Kriteria::distinct('kriteria')->pluck('kriteria');
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
        }
        return view('admin.subkriteria', ['data' => $data, 'subkriteria'=>$subkriteria, 'distinct_kriteria' => $distinct_kriteria]);
    }

    public function index(){
        return view('admin.dashboard');
    }

    public function alternatif(Request $request){
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;

        if (strlen($katakunci)) {
            $data = alternatif::where('nim', 'like', '%' . $katakunci . '%')
                        ->orWhere('nama', 'like', '%' . $katakunci . '%')
                        ->orWhere('prodi', 'like', '%' . $katakunci . '%')
                        ->paginate($jumlahbaris);
        } else {
            $data = alternatif::paginate($jumlahbaris);
        }

        return view('admin.alternatif', ['data' => $data]);
        
        // return view('admin.alternatif');
    }

    public function nilai(){
        $data = alternatif::distinct('nama')->pluck('nama');
        return view('admin.nilai', ['data' => $data]);
    }

    public function spk(){
        return view('admin.spk');
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
        $data2 = alternatif::where('nim',$id)->first();
        return view('admin.editalternatif',['data2' => $data2]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $request->validate([
            'nim'=>'required|numeric|unique:tb_data_alternatif,da_nim',
            'nama'=>'required',
            'prodi'=>'required',
            'ipk'=>'required',
            'lab'=>'required',
            'sertif_prestasi'=>'required',
            'sertif_organisasi'=>'required',
            'nilai_tulis'=>'required',
            'nilai_wawancara'=>'required',
        ],[
            'nim.required'=>'NIM wajib diisi',
            'nim.numeric'=>'NIM wajib dalam angka',
            'nim.unique'=>'NIM tidak boleh sama',
            'nama.required'=>'Nama wajib diisi',
            'prodi.required'=>'Program Studi wajib diisi',
            'ipk.required'=>'IPK wajib diisi',
            'lab.required'=>'Laboratorium wajib diisi',
            'sertif_prestasi.required'=>'Sertifikat Prestasi wajib diisi',
            'sertif_organisasi.required'=>'Sertifikat Organisasi wajib diisi',
            'nilai_tulis.required'=>'Nilai Tes Tulis wajib diisi',
            'nilai_wawancara.required'=>'Nilai Tes Wawancara wajib diisi',
        ]);
        $data3 = [
            'da_nim'=>$request->nim,
            'da_nama'=>$request->nama,
            'da_prodi'=>$request->prodi,
            'da_ipk'=>$request->ipk,
            'da_lab'=>$request->lab,
            'da_sertif_prestasi'=>$request->sertif_prestasi,
            'da_sertif_organisasi'=>$request->sertif_organisasi,
            'da_nilai_tulis'=>$request->nilai_tulis,
            'da_nilai_wawancara'=>$request->nilai_wawancara,
        ];
        data_alternatif::create($data3);
        return redirect()->route('alternatif')->with('success', 'Data Berhasil Ditambahkan!');
    }
    
    public function storeKriteria(Request $request){
        $request->validate([
            'kriteria'=>'required',
            'bobot'=>'required|numeric'
        ],[
            'kriteria.required'=>'Kriteria wajib diisi',
            'bobot.required'=>'Bobot wajib diisi',
            'bobot.numeric'=>'Bobot harus dalam angka'
        ]);
        $data = [
            'kriteria'=>$request->kriteria,
            'bobot'=>$request->bobot
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
            'kriteria'=>'required',
            'bobot'=>'required|numeric'
        ],[
            'kriteria.required'=>'Kriteria wajib diisi',
            'bobot.required'=>'Bobot wajib diisi',
            'bobot.numeric'=>'Bobot harus dalam angka'
        ]);
        $data = [
            'kriteria'=>$request->kriteria,
            'bobot'=>$request->bobot
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
            'nilai'=>$request->nilai
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
        $data = [
            'kriteria'=>$request->kriteria,
            'subkriteria'=>$request->subkriteria,
            'nilai'=>$request->nilai
        ];
        subkriteria::where('subkriteria',$id)->update($data);
        return redirect()->route('subkriteria')->with('success', 'Data Berhasil Diupdate!');
    }

    public function del_sub($id){
        subkriteria::where('subkriteria',$id)->delete();
        return redirect()->route('subkriteria')->with('success', 'Data Berhasil dihapus!');
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