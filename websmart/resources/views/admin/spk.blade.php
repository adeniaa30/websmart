@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')
            {{-- TABEL KRITERIA --}}
            <div>
                <h4>Tabel Kriteria</h2>
            </div>
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Nama Kriteria</th>
                            <th class="col-md-1">Bobot</th>
                            <th class="col-md-1">Normalisasi</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>IPK</td>
                            <td>90</td>
                            <td>0,37876</td>
                            <td>
                                <a href='' class="btn btn-warning btn-sm">Edit</a>
                                <a href='' class="btn btn-danger btn-sm">Del</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td>90</td>
                        </tr>
                    </tbody>
                </table>
               
            </div>

            {{-- TABEL Alternatif --}}
            <div>
                <h4>Tabel Alternatif</h2>
            </div>
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="">Nama</th>
                            <th class="">Nilai IPK</th>
                            <th class="">Nilai Sertif Prestasi/Porto</th>
                            <th class="">Nilai Tes Tulis</th>
                            <th class="">Nilai Tes Wawancara</th>
                            <th class="">Nilai Matkul</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nurul Hapsari Adenia</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>
                                <a href='' class="btn btn-warning btn-sm">Edit</a>
                                <a href='' class="btn btn-danger btn-sm">Del</a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Cmin</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Cmax</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
               
          </div>

          {{-- TABEL Utilitas --}}
          <div>
            <h4>Tabel Utilitas</h2>
        </div>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th class="">Nama</th>
                        <th class="">IPK</th>
                        <th class="">Sertif Prestasi/Porto</th>
                        <th class="">Tes Tulis</th>
                        <th class="">Tes Wawancara</th>
                        <th class="">Matkul</th>
                        <th class="">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nurul Hapsari Adenia</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>
                            <a href='' class="btn btn-warning btn-sm">Edit</a>
                            <a href='' class="btn btn-danger btn-sm">Del</a>
                        </td>
                    </tr>
                </tbody>
            </table>
           
      </div>

      {{-- TABEL Nilai Akhir --}}
      <div>
        <h4>Tabel Nilai Akhir</h2>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="">No</th>
                    <th class="">Nama</th>
                    <th class="">IPK</th>
                    <th class="">Sertif Prestasi/Porto</th>
                    <th class="">Tes Tulis</th>
                    <th class="">Tes Wawancara</th>
                    <th class="">Matkul</th>
                    <th class="">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nurul Hapsari Adenia</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>
                        <a href='' class="btn btn-warning btn-sm">Edit</a>
                        <a href='' class="btn btn-danger btn-sm">Del</a>
                    </td>
                </tr>
            </tbody>
        </table>
       
  </div>
@endsection