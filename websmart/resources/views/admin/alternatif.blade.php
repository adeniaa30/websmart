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

          <!-- Display Laboratory Name Based on User Name -->
        @if (Auth::check() && Auth::user()->name === 'aslab pc')
        <div>
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
                            <th class="">Lab Pilihan</th>
                            <th class="">KHS</th>
                            <th class="">Nilai Matkul PPL Agro</th>
                            <th class="">Nilai Matkul Sistem Digital</th>
                            <th class="">Nilai Matkul PAA</th>
                            <th class="">Sertif Lomba</th>
                            <th class="">Link Portofolio</th>
                            <th class="">Nilai Tes Tulis</th>
                            <th class="">Nilai Wawancara</th>
                            <th class="">Bertanggung Jawab</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data_lab_pc as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->da_nim }}</td>
                            <td>{{ $item->da_nama }}</td>
                            <td>{{ $item->da_lab }}</td>
                            <td>
                                {{ $item->khs}}
                                <a href="{{ route('showpdf_khs', ['id' => $item->id]) }}" target="_blank">Preview</a>                            
                            </td>
                            <td>{{ $item->pc_ppla }}</td>
                            <td>{{ $item->pc_sd}}</td>
                            <td>{{ $item->pc_paa }}</td>
                            <td>
                                {{ $item->da_sertif_prestasi}}
                                <a href="{{ route('showpdf_sertifprestasi', ['id' => $item->id]) }}" target="_blank">Preview</a>                            
                            </td>
                            <td><a href="{{ $item->pc_link_project }}" target="_blank" rel="noopener noreferrer">{{ $item->pc_link_project }}</a></td>
                            <td>{{ $item->da_nilai_tulis }}</td>
                            <td>{{ $item->da_nilai_wawancara }}</td>
                            <td>{{ $item->pc_tanggung_jawab }}</td>
                            <td>{{ $item->ide_project }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->da_nim.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->da_nama.'/del_calon') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{ $data_lab_pc->links() }}
            </div>
        </div>
        @elseif (Auth::check() && Auth::user()->name === 'aslab ai')
        <div>
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div>
                    <h4>Data Calon Aslab</h2>
                </div>
                <table class="table table-striped" style="width: 100vw;">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="">NIM</th>
                            <th class="">Nama</th>
                            <th class="">Lab Pilihan</th>
                            <th class="">KHS</th>
                            <th class="">Nilai Matkul Keckom</th>
                            <th class="">Nilai Matkul KB</th>
                            <th class="">Nilai Matkul PKB</th>
                            <th class="">Nilai Matkul Datmin</th>
                            <th class="">Sertif Prestasi</th>
                            <th class="">Sertif Organisasi</th>
                            <th class="">Nilai Wawancara</th>
                            <th class="">Ide Project</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data_lab_ai as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->da_nim }}</td>
                            <td>{{ $item->da_nama }}</td>
                            <td>{{ $item->da_lab }}</td>
                            <td>
                                {{ $item->khs}}
                                <a href="{{ route('showpdf_khs', ['id' => $item->id]) }}" target="_blank">Preview</a>                            
                            </td>
                            <td>{{ $item->nilai_keckom }}</td>
                            <td>{{ $item->nilai_kb}}</td>
                            <td>{{ $item->nilai_pkb }}</td>
                            <td>{{ $item->nilai_datmin }}</td>
                            <td>
                                {{ $item->da_sertif_prestasi}}
                                <a href="{{ route('showpdf_sertifprestasi', ['id' => $item->id]) }}" target="_blank">Preview</a>                            
                            </td>
                            <td>
                                {{ $item->da_sertif_organisasi}}
                                <a href="{{ route('showpdf_sertiforganisasi', ['id' => $item->id]) }}" target="_blank">Preview</a>                            
                            </td>
                            <td>{{ $item->da_nilai_wawancara }}</td>
                            <td>{{ $item->ide_project }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->da_nim.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->da_nama.'/del_calon') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{ $data_lab_ai->links() }}
            </div>
        </div>
        @endif

        


          <!-- AKHIR DATA -->
          
@endsection