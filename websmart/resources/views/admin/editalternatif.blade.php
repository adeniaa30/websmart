@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')

@if (Auth::check() && Auth::user()->name === 'aslab rpl'
)    
<form action='{{ url('update_alternatif/'.$data2->nim.'/'.$data2->lab) }}' method='post' enctype="multipart/form-data">
    @csrf
    @method('PUT')    
@elseif (Auth::check() && Auth::user()->name === 'aslab ai' ||
Auth::user()->name === 'aslab it' ||
Auth::user()->name === 'aslab pc'
)    
<form action='{{ url('update_alternatif/'.$data2->da_nim.'/'.$data2->da_lab) }}' method='post' enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{-- @if (Auth::check() && Auth::user()->name === 'aslab ai' ||
        Auth::user()->name === 'aslab it' ||
        Auth::user()->name === 'aslab pc'
        )     --}}
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nim' id="nim" value="{{ $data2->da_nim }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' id="nama" value="{{ $data2->da_nama }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='prodi' id="prodi" value="{{ $data2->da_prodi }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='ipk' id="ipk" value="{{ $data2->da_ipk }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="lab" class="col-sm-2 col-form-label">Pilih Laboratorium</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='lab' id="lab" value="{{ $data2->da_lab }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        @endif
        @if (Auth::check() && Auth::user()->name === 'aslab ai')
        <div class="mb-3 row">
            <label for="teswawancara" class="col-sm-2 col-form-label">Nilai Tes Wawancara</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nilai_wawancara' id="teswawancara">
            </div>
        </div>
        @elseif(Auth::check() && Auth::user()->name === 'aslab pc')
        <div class="mb-3 row">
            <label for="teswawancara" class="col-sm-2 col-form-label">Nilai Tes Wawancara</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nilai_wawancara' id="teswawancara">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="testulis" class="col-sm-2 col-form-label">Nilai Tes Tulis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nilai_tulis' id="tulis">
            </div>
        </div>
        @elseif(Auth::check() && Auth::user()->name === 'aslab it')
        <div class="mb-3 row">
            <label for="testulis" class="col-sm-2 col-form-label">Nilai Tes Tulis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nilai_tulis' id="tulis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="itnilai_mengajar" class="col-sm-2 col-form-label">Kemampuan Mengajar</label>
            <div class="col-sm-10">
                <select name="itnilai_mengajar" id="itnilai_mengajar" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup Baik">Cukup Baik</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="itnilai_probsolv" class="col-sm-2 col-form-label">Problem Solving</label>
            <div class="col-sm-10">
                <select name="itnilai_probsolv" id="itnilai_probsolv" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup Baik">Cukup Baik</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="itnilai_timemj" class="col-sm-2 col-form-label">Time Manajement</label>
            <div class="col-sm-10">
                <select name="itnilai_timemj" id="itnilai_timemj" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup Baik">Cukup Baik</option>
                </select>

            </div>
        </div>
        @elseif(Auth::check() && Auth::user()->name === 'aslab rpl')
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nim' id="nim" value="{{ $data2->nim }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' id="nama" value="{{ $data2->nama }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="lab" class="col-sm-2 col-form-label">Pilih Laboratorium</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='lab' id="lab" value="{{ $data2->lab }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="visi" class="col-sm-2 col-form-label">Nilai Visi</label>
            <div class="col-sm-10">
                <select name="visi" id="visi" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="wawasan" class="col-sm-2 col-form-label">Nilai wawasan</label>
            <div class="col-sm-10">
                <select name="wawasan" id="wawasan" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="komitmen" class="col-sm-2 col-form-label">Nilai komitmen</label>
            <div class="col-sm-10">
                <select name="komitmen" id="komitmen" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="fairness" class="col-sm-2 col-form-label">Nilai fairness</label>
            <div class="col-sm-10">
                <select name="fairness" id="fairness" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="teamwork" class="col-sm-2 col-form-label">Nilai teamwork</label>
            <div class="col-sm-10">
                <select name="teamwork" id="teamwork" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="potensi" class="col-sm-2 col-form-label">Nilai potensi</label>
            <div class="col-sm-10">
                <select name="potensi" id="potensi" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="analisis" class="col-sm-2 col-form-label">Nilai analisis</label>
            <div class="col-sm-10">
                <select name="analisis" id="analisis" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="technical" class="col-sm-2 col-form-label">Nilai technical</label>
            <div class="col-sm-10">
                <select name="technical" id="technical" class="form-control">
                    <option disable selected>Pilih Nilai</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>


        @endif
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
        </div>
      </form>
    </div>

@endsection