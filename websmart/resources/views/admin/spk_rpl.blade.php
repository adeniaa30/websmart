@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')
            

      {{-- TABEL Nilai Akhir --}}
      <div>
        <h4>Tabel Hasil Seleksi Aslab Laboratorium Rekayasa Perangkat Lunak</h2>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form method="POST" action="{{ url('kategori_hasil_rpl') }}">
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
                        <th class="">Nama</th>
                        <th class="">Nilai algo1</th>
                        <th class="">Nilai pbo</th>
                        <th class="">Nilai sql</th>
                        <th class="">Nilai pweb</th>
                        <th class="">Nilai paa</th>
                        <th class="">Nilai uiux</th>
                        <th class="">Nilai ood</th>
                        <th class="">Nilai algo2</th>
                        <th class="">Nilai pmobile</th>
                        <th class="">Nilai sbd</th>
                        <th class="">Nilai tkti</th>
                        <th class="">Nilai adpl</th>
                        <th class="">Nilai mpti</th>
                        <th class="">Nilai ppla</th>
                        <th class="">Nilai visi</th>
                        <th class="">Nilai wawasan</th>
                        <th class="">Nilai komitmen</th>
                        <th class="">Nilai fairness</th>
                        <th class="">Nilai teamwork</th>
                        <th class="">Nilai potensi</th>
                        <th class="">Nilai analisis</th>
                        <th class="">Nilai technical</th>
                        <th class="">Nilai portofolio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $nilai_alt->firstItem() ?>
                    @foreach ($nilai_alt as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->algo1 }}</td>
                        <td>{{ $item->pbo}}</td>
                        <td>{{ $item->sql }}</td>
                        <td>{{ $item->pweb }}</td>
                        <td>
                            {{ $item->uiux }}
                        </td>
                        <td>{{ $item->ood }}</td>
                        <td>{{ $item->algo2 }}</td>
                        <td>{{ $item->paa }}</td>
                        <td>{{ $item->pmobile }}</td>
                        <td>{{ $item->sbd }}</td>
                        <td>{{ $item->tkti }}</td>
                        <td>{{ $item->adpl }}</td>
                        <td>{{ $item->mpti }}</td>
                        <td>{{ $item->ppla }}</td>
                        <td>{{ $item->visi }}</td>
                        <td>{{ $item->wawasan }}</td>
                        <td>{{ $item->komitmen }}</td>
                        <td>{{ $item->fairness }}</td>
                        <td>{{ $item->teamwork }}</td>
                        <td>{{ $item->potensi }}</td>
                        <td>{{ $item->analisis }}</td>
                        <td>{{ $item->technical }}</td>
                        <td>{{ $item->portofolio }}</td>
                </tr>
                    <?php $i++ ?>
                    @endforeach
                    <tr>
                        <td>Cmin</td>
                        <td></td>
                        <td>{{ $cmin['min_algo1'] }}</td>
                        <td>{{ $cmin['min_pbo'] }}</td>
                        <td>{{ $cmin['min_sql'] }}</td>
                        <td>{{ $cmin['min_pweb'] }}</td>
                        <td>{{ $cmin['min_paa'] }}</td>
                        <td>{{ $cmin['min_uiux'] }}</td>
                        <td>{{ $cmin['min_ood'] }}</td>
                        <td>{{ $cmin['min_algo2'] }}</td>
                        <td>{{ $cmin['min_pmobile'] }}</td>
                        <td>{{ $cmin['min_sbd'] }}</td>
                        <td>{{ $cmin['min_tkti'] }}</td>
                        <td>{{ $cmin['min_adpl'] }}</td>
                        <td>{{ $cmin['min_mpti'] }}</td>
                        <td>{{ $cmin['min_ppla'] }}</td>
                        <td>{{ $cmin['min_visi'] }}</td>
                        <td>{{ $cmin['min_wawasan'] }}</td>
                        <td>{{ $cmin['min_komitmen'] }}</td>
                        <td>{{ $cmin['min_fairness'] }}</td>
                        <td>{{ $cmin['min_teamwork'] }}</td>
                        <td>{{ $cmin['min_potensi'] }}</td>
                        <td>{{ $cmin['min_analisis'] }}</td>
                        <td>{{ $cmin['min_technical'] }}</td>
                        <td>{{ $cmin['min_portofolio'] }}</td>
                    </tr>
                    <tr>
                        <td>Cmax</td>
                        <td></td>
                        <td>{{ $cmax['max_algo1'] }}</td>
                        <td>{{ $cmax['max_pbo'] }}</td>
                        <td>{{ $cmax['max_sql'] }}</td>
                        <td>{{ $cmax['max_pweb'] }}</td>
                        <td>{{ $cmax['max_paa'] }}</td>
                        <td>{{ $cmax['max_uiux'] }}</td>
                        <td>{{ $cmax['max_ood'] }}</td>
                        <td>{{ $cmax['max_algo2'] }}</td>
                        <td>{{ $cmax['max_pmobile'] }}</td>
                        <td>{{ $cmax['max_sbd'] }}</td>
                        <td>{{ $cmax['max_tkti'] }}</td>
                        <td>{{ $cmax['max_adpl'] }}</td>
                        <td>{{ $cmax['max_mpti'] }}</td>
                        <td>{{ $cmax['max_ppla'] }}</td>
                        <td>{{ $cmax['max_visi'] }}</td>
                        <td>{{ $cmax['max_wawasan'] }}</td>
                        <td>{{ $cmax['max_komitmen'] }}</td>
                        <td>{{ $cmax['max_fairness'] }}</td>
                        <td>{{ $cmax['max_teamwork'] }}</td>
                        <td>{{ $cmax['max_potensi'] }}</td>
                        <td>{{ $cmax['max_analisis'] }}</td>
                        <td>{{ $cmax['max_technical'] }}</td>
                        <td>{{ $cmax['max_portofolio'] }}</td>
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
                    <th class="">Nama</th>
                    <th class="">Nilai algo1</th>
                    <th class="">Nilai pbo</th>
                    <th class="">Nilai sql</th>
                    <th class="">Nilai pweb</th>
                    <th class="">Nilai paa</th>
                    <th class="">Nilai uiux</th>
                    <th class="">Nilai ood</th>
                    <th class="">Nilai algo2</th>
                    <th class="">Nilai pmobile</th>
                    <th class="">Nilai sbd</th>
                    <th class="">Nilai tkti</th>
                    <th class="">Nilai adpl</th>
                    <th class="">Nilai mpti</th>
                    <th class="">Nilai ppla</th>
                    <th class="">Nilai visi</th>
                    <th class="">Nilai wawasan</th>
                    <th class="">Nilai komitmen</th>
                    <th class="">Nilai fairness</th>
                    <th class="">Nilai teamwork</th>
                    <th class="">Nilai potensi</th>
                    <th class="">Nilai analisis</th>
                    <th class="">Nilai technical</th>
                    <th class="">Nilai portofolio</th>
        </tr>
            </thead>
            <tbody>
                <?php $i = $uti->firstItem() ?>
                @foreach ($uti as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->algo1 }}</td>
                    <td>{{ $item->pbo}}</td>
                    <td>{{ $item->sql }}</td>
                    <td>{{ $item->pweb }}</td>
                    <td>
                        {{ $item->uiux }}
                    </td>
                    <td>{{ $item->ood }}</td>
                    <td>{{ $item->algo2 }}</td>
                    <td>{{ $item->paa }}</td>
                    <td>{{ $item->pmobile }}</td>
                    <td>{{ $item->sbd }}</td>
                    <td>{{ $item->tkti }}</td>
                    <td>{{ $item->adpl }}</td>
                    <td>{{ $item->mpti }}</td>
                    <td>{{ $item->ppla }}</td>
                    <td>{{ $item->visi }}</td>
                    <td>{{ $item->wawasan }}</td>
                    <td>{{ $item->komitmen }}</td>
                    <td>{{ $item->fairness }}</td>
                    <td>{{ $item->teamwork }}</td>
                    <td>{{ $item->potensi }}</td>
                    <td>{{ $item->analisis }}</td>
                    <td>{{ $item->technical }}</td>
                    <td>{{ $item->portofolio }}</td>
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
                    <th class="">Nama</th>
                    <th class="">Nilai algo1</th>
                    <th class="">Nilai pbo</th>
                    <th class="">Nilai sql</th>
                    <th class="">Nilai pweb</th>
                    <th class="">Nilai paa</th>
                    <th class="">Nilai uiux</th>
                    <th class="">Nilai ood</th>
                    <th class="">Nilai algo2</th>
                    <th class="">Nilai pmobile</th>
                    <th class="">Nilai sbd</th>
                    <th class="">Nilai tkti</th>
                    <th class="">Nilai adpl</th>
                    <th class="">Nilai mpti</th>
                    <th class="">Nilai ppla</th>
                    <th class="">Nilai visi</th>
                    <th class="">Nilai wawasan</th>
                    <th class="">Nilai komitmen</th>
                    <th class="">Nilai fairness</th>
                    <th class="">Nilai teamwork</th>
                    <th class="">Nilai potensi</th>
                    <th class="">Nilai analisis</th>
                    <th class="">Nilai technical</th>
                    <th class="">Nilai portofolio</th>
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
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->algo1 }}</td>
                    <td>{{ $item->pbo}}</td>
                    <td>{{ $item->sql }}</td>
                    <td>{{ $item->pweb }}</td>
                    <td>
                        {{ $item->uiux }}
                    </td>
                    <td>{{ $item->ood }}</td>
                    <td>{{ $item->algo2 }}</td>
                    <td>{{ $item->paa }}</td>
                    <td>{{ $item->pmobile }}</td>
                    <td>{{ $item->sbd }}</td>
                    <td>{{ $item->tkti }}</td>
                    <td>{{ $item->adpl }}</td>
                    <td>{{ $item->mpti }}</td>
                    <td>{{ $item->ppla }}</td>
                    <td>{{ $item->visi }}</td>
                    <td>{{ $item->wawasan }}</td>
                    <td>{{ $item->komitmen }}</td>
                    <td>{{ $item->fairness }}</td>
                    <td>{{ $item->teamwork }}</td>
                    <td>{{ $item->potensi }}</td>
                    <td>{{ $item->analisis }}</td>
                    <td>{{ $item->technical }}</td>
                    <td>{{ $item->portofolio }}</td>
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