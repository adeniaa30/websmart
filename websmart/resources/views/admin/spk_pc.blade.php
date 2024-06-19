@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')
            

      {{-- TABEL Nilai Akhir --}}
      <div>
        <h4>Tabel Hasil Seleksi Aslab Laboratorium Pertanian Cerdas</h2>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form method="POST" action="{{ url('kategori_hasil_pc') }}">
            @csrf
            <div class="mb-3 row">
                <label for="lolos" class="col-sm-2 col-form-label">Masukkan angka penerimaan aslab : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name='lolos' id="lolos">
                </div>
                <label for="submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
            </div>
        </form>    

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="">Ranking</th>
                    <th class="">Nama</th>
                    <th class="">Nilai Akhir</th>
                    <th class="">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($total as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->total }}</td>
                    <td>
                        @if($item->status == 'LOLOS')
                            <span class="badge bg-success">LOLOS</span>
                        @elseif($item->status == 'GAGAL')
                            <span class="badge bg-danger">GAGAL</span>
                        @endif
                    </td>
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
                        <td>{{ $item->norm_kriteria }}</td>
                        <td>{{ $item->norm_bobot }}</td>
                        <td>{{ $item->normalisasi }}</td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                    <tr>
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
                        <th class="">Sertif Lomba</th>
                        <th class="">Project</th>
                        <th class="">Pengalaman</th>
                        <th class="">Tes Tulis</th>
                        <th class="">Tes Wawancara</th>
                        <th class="">Matkul PPLA</th>
                        <th class="">Matkul SD</th>
                        <th class="">Matkul PAA</th>
                        <th class="">Bertanggung Jawab</th>
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
                        <td>{{ $item->nilaipc_project }}</td>
                        <td>{{ $item->nilaipc_pengalaman }}</td>
                        <td>{{ $item->nilai_tulis }}</td>
                        <td>{{ $item->nilai_wawancara }}</td>
                        <td>{{ $item->nilaipc_ppla }}</td>
                        <td>{{ $item->nilaipc_sd }}</td>
                        <td>{{ $item->nilaipc_paa }}</td>
                        <td>{{ $item->nilaipc_tanggungjawab }}</td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Cmin</td>
                        <td></td>
                        <td>{{ $cmin->min_sp }}</td>
                        <td>{{ $cmin->min_project }}</td>
                        <td>{{ $cmin->min_pengalaman }}</td>
                        <td>{{ $cmin->min_tulis }}</td>
                        <td>{{ $cmin->min_wawancara }}</td>
                        <td>{{ $cmin->min_ppla }}</td>
                        <td>{{ $cmin->min_sd }}</td>
                        <td>{{ $cmin->min_paa }}</td>
                        <td>{{ $cmin->min_tanggungjawab }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Cmax</td>
                        <td></td>
                        <td>{{ $cmax->max_sp }}</td>
                        <td>{{ $cmax->max_project }}</td>
                        <td>{{ $cmax->max_pengalaman }}</td>
                        <td>{{ $cmax->max_tulis }}</td>
                        <td>{{ $cmax->max_wawancara }}</td>
                        <td>{{ $cmax->max_ppla }}</td>
                        <td>{{ $cmax->max_sd }}</td>
                        <td>{{ $cmax->max_paa }}</td>
                        <td>{{ $cmax->max_tanggungjawab }}</td>
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
                    <th class="">Sertif Lomba</th>
                    <th class="">Project</th>
                    <th class="">Pengalaman</th>
                    <th class="">Tes Tulis</th>
                    <th class="">Tes Wawancara</th>
                    <th class="">Matkul PPLA</th>
                    <th class="">Matkul SD</th>
                    <th class="">Matkul PAA</th>
                    <th class="">Bertanggung Jawab</th>
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
                    <td>{{ $item->utipc_project }}</td>
                    <td>{{ $item->utipc_pengalaman }}</td>
                    <td>{{ $item->uti_tulis }}</td>
                    <td>{{ $item->uti_wawancara }}</td>
                    <td>{{ $item->utipc_ppla }}</td>
                    <td>{{ $item->utipc_sd }}</td>
                    <td>{{ $item->utipc_paa }}</td>
                    <td>{{ $item->utipc_tanggung_jawab }}</td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        {{ $uti->links() }}
    </div>
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
                    <th class="">Sertif Lomba</th>
                    <th class="">Project</th>
                    <th class="">Pengalaman</th>
                    <th class="">Tes Tulis</th>
                    <th class="">Tes Wawancara</th>
                    <th class="">Matkul PPLA</th>
                    <th class="">Matkul SD</th>
                    <th class="">Matkul PAA</th>
                    <th class="">Bertanggung Jawab</th>
                    <th class="">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $na->firstItem() ?>
                <?php 
                // $j = 0 
                ?>
                @foreach ($na as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->lab }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->na_sertif_prestasi }}</td>
                    <td>{{ $item->napc_project }}</td>
                    <td>{{ $item->napc_pengalaman }}</td>
                    <td>{{ $item->na_tulis }}</td>
                    <td>{{ $item->na_wawancara }}</td>
                    <td>{{ $item->napc_ppla }}</td>
                    <td>{{ $item->napc_sd }}</td>
                    <td>{{ $item->napc_paa }}</td>
                    <td>{{ $item->napc_tanggung_jawab }}</td>
                    {{-- <td>{{ $item->na_matkuly }}</td>
                    <td>{{ $item->na_matkulz }}</td> --}}
                    <td>
                        {{ $item->total }} <!-- Access corresponding element from $result array -->
                    </td>
                <?php $i++ ?>
                <?php 
                // $j++ 
                ?>
                @endforeach
                </tr>
            </tbody>
        </table>
        {{ $na->links() }}
  </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection