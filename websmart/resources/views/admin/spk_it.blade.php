@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')
            

      {{-- TABEL Nilai Akhir --}}
      <div>
        <h4>Tabel Hasil Seleksi Aslab Laboratorium Infrastruktur Teknologi</h2>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form method="POST" action="{{ url('kategori_hasil_it') }}">
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
                    {{-- <th class="">Rangking</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php 
                    // $i = $total->firstItem() 
                ?>
                <?php 
                // $j = 0 
                ?>
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
                     {{-- <td>{{ $rank[$j] }}</td>  --}}
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
                        <th class="">Pengalaman</th>
                        <th class="">Nilai Tes</th>
                        <th class="">Nilai SO</th>
                        <th class="">Nilai Jarkom</th>
                        <th class="">Nilai DMJ</th>
                        <th class="">Nilai RnS</th>
                        <th class="">Nilai Mengajar</th>
                        <th class="">Nilai Probsolv</th>
                        <th class="">Nilai Timemj</th>
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
                        <td>{{ $item->nilai_tulis }}</td>
                        <td>{{ $item->itnilai_sop }}</td>
                        <td>{{ $item->itnilai_jarkom }}</td>
                        <td>{{ $item->itnilai_dmj }}</td>
                        <td>{{ $item->itnilai_rns }}</td>
                        <td>{{ $item->itnilai_mengajar }}</td>
                        <td>{{ $item->itnilai_probsolv }}</td>
                        <td>{{ $item->itnilai_timemj }}</td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Cmin</td>
                        <td></td>
                        <td>{{ $cmin->min_sp }}</td>
                        <td>{{ $cmin->min_tulis }}</td>
                        <td>{{ $cmin->min_sop }}</td>
                        <td>{{ $cmin->min_jarkom }}</td>
                        <td>{{ $cmin->min_dmj }}</td>
                        <td>{{ $cmin->min_rns }}</td>
                        <td>{{ $cmin->min_mengajar }}</td>
                        <td>{{ $cmin->min_probsolv }}</td>
                        <td>{{ $cmin->min_timemj }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Cmax</td>
                        <td></td>
                        <td>{{ $cmax->max_sp }}</td>
                        <td>{{ $cmax->max_tulis }}</td>
                        <td>{{ $cmax->max_sop }}</td>
                        <td>{{ $cmax->max_jarkom }}</td>
                        <td>{{ $cmax->max_dmj }}</td>
                        <td>{{ $cmax->max_rns }}</td>
                        <td>{{ $cmax->max_mengajar }}</td>
                        <td>{{ $cmax->max_probsolv }}</td>
                        <td>{{ $cmax->max_timemj }}</td>
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
                    <th class="">Pengalaman</th>
                    <th class="">Nilai SO</th>
                    <th class="">Nilai Tulis</th>
                    <th class="">Nilai Jarkom</th>
                    <th class="">Nilai DMJ</th>
                    <th class="">Nilai RnS</th>
                    <th class="">Nilai Mengajar</th>
                    <th class="">Nilai Probsolv</th>
                    <th class="">Nilai Timemj</th>
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
                    <td>{{ $item->uti_tulis }}</td>
                    <td>{{ $item->itnilai_sop }}</td>
                    <td>{{ $item->itnilai_jarkom }}</td>
                    <td>{{ $item->itnilai_dmj }}</td>
                    <td>{{ $item->itnilai_rns }}</td>
                    <td>{{ $item->itnilai_mengajar }}</td>
                    <td>{{ $item->itnilai_probsolv }}</td>
                    <td>{{ $item->itnilai_timemj }}</td>
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
                    <th class="">Pengalaman</th>
                    <th class="">Nilai Tulis</th>
                    <th class="">Nilai SO</th>
                    <th class="">Nilai Jarkom</th>
                    <th class="">Nilai DMJ</th>
                    <th class="">Nilai RnS</th>
                    <th class="">Nilai Mengajar</th>
                    <th class="">Nilai Probsolv</th>
                    <th class="">Nilai Timemj</th>
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
                    <td>{{ $item->na_tulis }}</td>
                    <td>{{ $item->itnilai_sop }}</td>
                    <td>{{ $item->itnilai_jarkom }}</td>
                    <td>{{ $item->itnilai_dmj }}</td>
                    <td>{{ $item->itnilai_rns }}</td>
                    <td>{{ $item->itnilai_mengajar }}</td>
                    <td>{{ $item->itnilai_probsolv }}</td>
                    <td>{{ $item->itnilai_timemj }}</td>
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