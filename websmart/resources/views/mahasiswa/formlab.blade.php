@extends('template.sidebarmhs')
@extends('template.template')

@section('konten')
    <!-- START FORM -->

    <div class="pb-3 center-container">
        <form class="d-flex" action="{{ url('showform') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan NIM atau Nama" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>
@endsection