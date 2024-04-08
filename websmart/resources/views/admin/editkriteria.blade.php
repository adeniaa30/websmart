@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')

<form action='{{ url('update_kriteria/'.$data->kriteria) }}' method='post'>
@csrf
@method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->kriteria }}"  name='kriteria' id="kriteria" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" value="{{ $data->bobot }}"  name='bobot' id="bobot">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
    </form>

@endsection