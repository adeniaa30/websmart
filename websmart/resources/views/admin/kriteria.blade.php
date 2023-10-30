@extends('template.template')
@extends('template.sidebaradmin')

@section('konten')
        <!-- START FORM -->
<form action='' method='post'>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='kriteria' id="kriteria">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='bobot' id="bobot">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                {{-- <div class="pb-3">
                  <form class="d-flex" action="" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div> --}}
                
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <a href='' class="btn btn-primary">+ Tambah Data</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Nama Kriteria</th>
                            <th class="col-md-1">Bobot</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>IPK</td>
                            <td>90</td>
                            <td>
                                <a href='' class="btn btn-warning btn-sm">Edit</a>
                                <a href='' class="btn btn-danger btn-sm">Del</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
          </div>
          <!-- AKHIR DATA -->
@endsection