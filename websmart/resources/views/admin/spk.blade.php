@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')
            

      {{-- TABEL Nilai Akhir --}}
      
    {{-- @if (Auth::check() && Auth::user()->name === 'aslab ai') --}}
    <div>
        <h4>Tabel Hasil Seleksi Laboratorium AI</h2>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="">Rangking</th>
                    <th class="">Nama</th>
                    <th class="">Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // $i = $na->firstItem() 
                    ?>
                <?php 
                // $j = 0 
                ?>
                @foreach($total as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
                <?php 
                // $i++ 
                ?>
                <?php
                // $j++;
                ?>
                @endforeach
            </tbody>
        </table>
        {{ $na->links() }}
       
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
    View Details
  </button>
  <!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Details content -->
          {{-- TABEL KRITERIA --}}
          <div>
            <h4>Tabel Kriteria</h2>
        </div>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">Laboratorium</th>
                        <th class="col-md-3">Nama Kriteria</th>
                        <th class="col-md-1">Bobot</th>
                        <th class="col-md-1">Normalisasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $data->firstItem() ?>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->lab }}</td>
                        <td>{{ $item->norm_kriteria }}</td>
                        <td>{{ $item->norm_bobot }}</td>
                        <td>{{ $item->normalisasi }}</td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        <td>{{ $totalSum }}</td>
                    </tr>
                </tbody>
            </table>
            {{ $data->links() }}
           
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
                        <th class="">Laboratorium</th>
                        <th class="">Nama</th>
                        <th class="">Nilai Sertif Lomba</th>
                        <th class="">Nilai Sertif Organisasi</th>
                        <th class="">Nilai Wawancara</th>
                        <th class="">Nilai Matkul Kec.Kom</th>
                        <th class="">Nilai Matkul KB</th>
                        <th class="">Nilai Matkul PKB</th>
                        <th class="">Nilai Matkul Datmin</th>
                        <th class="">Nilai Kontribusi Ide</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $nilai_alt->firstItem() ?>
                    @foreach ($nilai_alt as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->lab }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nilai_sertif_prestasi }}</td>
                        <td>{{ $item->nilai_sertif_organisasi }}</td>
                        <td>{{ $item->nilai_wawancara }}</td>
                        <td>{{ $item->nilai_keckom }}</td>
                        <td>{{ $item->nilai_kb }}</td>
                        <td>{{ $item->nilai_pkb }}</td>
                        <td>{{ $item->nilai_datmin }}</td>
                        <td>{{ $item->nilai_kontribusi_ide }}</td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Cmin</td>
                        <td></td>
                        <td>{{ $cmin->min_sp }}</td>
                        <td>{{ $cmin->min_so }}</td>
                        <td>{{ $cmin->min_wawancara }}</td>
                        <td>{{ $cmin->min_keckom }}</td>
                        <td>{{ $cmin->min_kb }}</td>
                        <td>{{ $cmin->min_pkb }}</td>
                        <td>{{ $cmin->min_datmin }}</td>
                        <td>{{ $cmin->min_ide }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Cmax</td>
                        <td></td>
                        <td>{{ $cmax->max_sp }}</td>
                        <td>{{ $cmax->max_so }}</td>
                        <td>{{ $cmax->max_wawancara }}</td>
                        <td>{{ $cmax->max_keckom }}</td>
                        <td>{{ $cmax->max_kb }}</td>
                        <td>{{ $cmax->max_pkb }}</td>
                        <td>{{ $cmax->max_datmin }}</td>
                        <td>{{ $cmax->max_ide }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            {{ $nilai_alt->links() }}
           
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
                    <th class="">Laboratorium</th>
                    <th class="">Nama</th>
                    <th class="">Sertif Prestasi/Porto</th>
                    <th class="">Sertif Organisasi</th>
                    <th class="">Tes Wawancara</th>
                    <th class="">Matkul Kec.Kom</th>
                    <th class="">Matkul KB</th>
                    <th class="">Matkul PKB</th>
                    <th class="">Matkul Datmin</th>
                    <th class="">Kontribusi Ide</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $uti->firstItem() ?>
                @foreach ($uti as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->lab }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->uti_sertif_prestasi }}</td>
                    <td>{{ $item->uti_sertif_organisasi }}</td>
                    <td>{{ $item->uti_wawancara }}</td>
                    <td>{{ $item->uti_keckom }}</td>
                    <td>{{ $item->uti_kb }}</td>
                    <td>{{ $item->uti_pkb }}</td>
                    <td>{{ $item->uti_datmin }}</td>
                    <td>{{ $item->uti_kontribusi_ide }}</td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        {{ $uti->links() }}

        {{-- TABEL Utilitas --}}
      <div>
        <h4>Tabel Nilai Akhir</h2>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="">No</th>
                    <th class="">Laboratorium</th>
                    <th class="">Nama</th>
                    <th class="">Sertif Prestasi</th>
                    <th class="">Sertif Organisasi</th>
                    <th class="">Tes Wawancara</th>
                    <th class="">Matkul Kec.Kom</th>
                    <th class="">Matkul KB</th>
                    <th class="">Matkul PKB</th>
                    <th class="">Matkul Datmin</th>
                    <th class="">Kontribusi Ide</th>
                    {{-- <th class="">Matkul Y</th>
                    <th class="">Matkul Z</th> --}}
                    <th class="">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $na->firstItem() ?>
                <?php $j = 0 ?>
                @foreach ($na as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->lab }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->na_sertif_prestasi }}</td>
                    <td>{{ $item->na_sertif_organisasi }}</td>
                    <td>{{ $item->na_wawancara }}</td>
                    <td>{{ $item->na_keckom }}</td>
                    <td>{{ $item->na_kb }}</td>
                    <td>{{ $item->na_pkb }}</td>
                    <td>{{ $item->na_datmin }}</td>
                    <td>{{ $item->na_kontribusi_ide }}</td>
                    {{-- <td>{{ $item->na_matkuly }}</td>
                    <td>{{ $item->na_matkulz }}</td> --}}
                    <td>
                        {{ $item->total }} <!-- Access corresponding element from $result array -->
                    </td>
                <?php $i++ ?>
                <?php $j++ ?>
                @endforeach
                </tr>
            </tbody>
        </table>
        {{ $na->links() }}
       {{-- @endif --}}
  </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection