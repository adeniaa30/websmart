@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')

<form action='{{ url('update_alternatif') }}' method='post'>
@csrf
@method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
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
            <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='prodi' id="prodi" value="{{ $data2->prodi }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='ipk' id="ipk" value="{{ $data2->ipk }}" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="lab" class="col-sm-2 col-form-label">Pilih Laboratorium</label>
            <div class="col-sm-10">
                <select name="lab" id="lab" class="form-control">
                    <option disable selected>Pilih Laboratorium</option>
                    <option value="lab1">Lab 1</option>
                    <option value="lab2">Lab 2</option>
                    <option value="lab3">Lab 3</option>
                    <option value="lab4">Lab 4</option>
                    <option value="lab5">Lab 5</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="sp" class="col-sm-2 col-form-label">Upload Sertifikat Prestasi</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name='sertif_prestasi' id="sp">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="so" class="col-sm-2 col-form-label">Upload Sertifikat Organisasi/Kepanitiaan</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name='sertif_organisasi' id="so">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="testulis" class="col-sm-2 col-form-label">Nilai Tes Tulis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nilai_tulis' id="testulis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="teswawancara" class="col-sm-2 col-form-label">Nilai Tes Wawancara</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nilai_wawancara' id="teswawancara">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
        </div>
      </form>
    </div>

@endsection