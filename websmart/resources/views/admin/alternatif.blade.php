@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')

    <!-- START FORM -->
<form action='{{ url('store_alternatif') }}' method='post'>
@csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nim' id="nim">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-10">
                <select name="prodi" id="prodi" class="form-control">
                    <option disable selected>Pilih Program Studi</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknologi Informasi">Teknologi Informasi</option>
                    <option value="Informatika">Informatika</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='ipk' id="ipk">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                  <form class="d-flex" action="{{ url('alternatif') }}" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="">NIM</th>
                            <th class="">Nama</th>
                            <th class="">Program Studi</th>
                            <th class="">IPK</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $i = $data->firstItem() ?>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->prodi }}</td>
                            <td>{{ $item->ipk }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->nim.'/edit') }}' class="btn btn-warning btn-sm">Tambahkan Mahasiswa</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                        
                    </tbody>
                </table>
                {{ $data->links() }}
          </div>

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div>
                <h4>Data Calon Aslab</h2>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th class="">NIM</th>
                        <th class="">Nama</th>
                        <th class="">Program Studi</th>
                        <th class="">IPK</th>
                        <th class="">Lab Pilihan</th>
                        <th class="">Sertif Prestasi</th>
                        <th class="">Sertif Organisasi</th>
                        <th class="">Nilai Tes Tulis</th>
                        <th class="">Nilai Wawancara</th>
                        <th class="">Nilai Matkul X</th>
                        <th class="">Nilai Matkul Y</th>
                        <th class="">Nilai Matkul Z</th>
                        <th class="">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $i = $data_calon->firstItem() ?>
                    @foreach ($data_calon as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->da_nim }}</td>
                        <td>{{ $item->da_nama }}</td>
                        <td>{{ $item->da_prodi }}</td>
                        <td>{{ $item->da_ipk }}</td>
                        <td>{{ $item->da_lab }}</td>
                        <td>
                            @if ($item->da_sertif_prestasi)
                            <a href="{{ asset($item->da_sertif_prestasi) }}" target="_blank">{{ basename($item->da_sertif_prestasi) }}</a>
                        @else
                            No PDF file available
                        @endif
                        </td>
                        <td>
                            @if ($item->da_sertif_organisasi)
                            <a href="{{ asset($item->da_sertif_organisasi) }}" target="_blank">{{ basename($item->da_sertif_organisasi) }}</a>
                        @else
                            No PDF file available
                        @endif
                        </td>
                        <td>{{ $item->da_nilai_tulis }}</td>
                        <td>{{ $item->da_nilai_wawancara }}</td>
                        <td>{{ $item->da_nilai_matkulx }}</td>
                        <td>{{ $item->da_nilai_matkuly}}</td>
                        <td>{{ $item->da_nilai_matkulz }}</td>
                        <td>
                            <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->da_nim.'/del_calon') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                    
                </tbody>
            </table>
            {{ $data_calon->links() }}
        </div>


          <!-- AKHIR DATA -->
          
@endsection