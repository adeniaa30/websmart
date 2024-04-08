@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')

<form action='{{ url('update_sub/') }}' method='post'>
    @csrf
    @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='kriteria' id="kriteria" value="{{ $data->kriteria }}" aria-label="readonly input example" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="subkriteria" class="col-sm-2 col-form-label">Keterangan Subkriteria</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->subkriteria }}" name='subkriteria' id="subkriteria">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nilai" class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->nilai }}" name='nilai' id="nilai">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
            </div>
          </form>
        </div>

@endsection