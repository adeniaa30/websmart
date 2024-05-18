@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')

<form action='{{ url('update_alternatif/'.$data2->da_nim) }}' method='post' enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
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
        @endif
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
        </div>
      </form>
    </div>

@endsection