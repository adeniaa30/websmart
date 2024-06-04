@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')

 <!-- START FORM -->
 @if (Auth::check() && 
Auth::user()->name === 'aslab pc' ||
Auth::user()->name === 'aslab ai' ||
Auth::user()->name === 'aslab it'
) 
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
@endif
    <!-- AKHIR FORM -->

          <!-- Display Laboratory Name Based on User Name -->
          @if (Auth::check() && Auth::user()->name === 'aslab pc' || Auth::user()->name === 'kalab pertanian cerdas' )
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
                            <th class="">Status</th>
                            @if(Auth::check() && Auth::user()->name === 'aslab pc' )
                            <th class="">Aksi</th>
                            @endif
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
                                <a href="{{ route('showpdf_khs', ['id' => $item->id]) }}" target="_blank">KHS</a>                            
                            </td>
                            <td>{{ $item->pc_ppla }}</td>
                            <td>{{ $item->pc_sd}}</td>
                            <td>{{ $item->pc_paa }}</td>
                            <td>
                                <a href="{{ route('showpdf_sertifprestasi', ['id' => $item->id]) }}" target="_blank">Sertif Prestasi{{ $item->id }}</a>                            
                            </td>
                            <td><a href="{{ $item->pc_link_project }}" target="_blank" rel="noopener noreferrer">{{ $item->pc_link_project }}</a></td>
                            <td>{{ $item->da_nilai_tulis }}</td>
                            <td>{{ $item->da_nilai_wawancara }}</td>
                            <td>{{ $item->pc_tanggung_jawab }}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Checked</span>
                                @elseif($item->status == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </td>
                            @if(Auth::check() && Auth::user()->name === 'aslab pc' )
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="d-flex">
                                        <form id="approveForm_{{ $item->da_nama }}" action="{{ url('update_status/'.$item->da_nama.'/'.$item->da_lab) }}" method="post" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-sm btn-success approveBtn" data-nama="{{ $item->da_nama }}">                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form id="rejectForm_{{ $item->da_nama }}" action="{{ url('update_status/'. $item->da_nama.'/'.$item->da_lab) }}" method="post" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class="btn btn-sm btn-danger rejectBtn" data-nama="{{ $item->da_nama }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="d-flex">
                                        <a href='{{ url('admin/'.$item->da_nim.'/'.$item->da_lab.'/edit_da') }}' class="btn btn-warning btn-sm">Edit</a>
                                        <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->da_nama.'/'.$item->da_lab.'/del_calon') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                        </form>
                                    </div>

                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        @foreach($data_lab_pc as $item)
                            if ("{{ $item->status }}" == "2") {
                                document.querySelectorAll('.approveBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                    btn.style.display = 'none';
                                });
                                document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                    btn.style.display = 'none';
                                });                            
                            }
                            document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                btn.closest('form').addEventListener('submit', function(event) {
                                    event.preventDefault();  // Prevent the default form submission
                                    document.querySelectorAll('.approveBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                        btn.style.display = 'none';
                                    });
                                    document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                        btn.style.display = 'none';
                                    });
                                    this.submit();  // Submit the form programmatically
                                });
                            });
                        @endforeach
                    });
                </script>

                {{ $data_lab_pc->links() }}
            </div>
        </div>
        @elseif (Auth::check() && Auth::user()->name === 'aslab ai' || Auth::user()->name === 'kalab Artificial Intelligence' )
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
                            <th class="">KHS</th>
                            <th class="">Nilai Keckom</th>
                            <th class="">Nilai KB</th>
                            <th class="">Nilai PKB</th>
                            <th class="">Nilai Datmin</th>
                            <th class="">Sertif Prestasi</th>
                            <th class="">Status</th>
                            <th class="">Status Organisasi</th>
                            <th class="">Wawancara</th>
                            <th class="">Ide Project</th>
                            <th class="">Status</th>
                            @if (Auth::check() && Auth::user()->name === 'aslab ai')

                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            @endif
                        @foreach ($data_lab_ai as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->da_nim }}</td>
                            <td>{{ $item->da_nama }}</td>
                            <td>
                                <a href="{{ route('showpdf_khs', ['id' => $item->id]) }}" target="_blank">KHS</a>                            
                            </td>
                            <td>{{ $item->nilai_keckom }}</td>
                            <td>{{ $item->nilai_kb}}</td>
                            <td>{{ $item->nilai_pkb }}</td>
                            <td>{{ $item->nilai_datmin }}</td>
                            <td>
                                <a href="{{ route('showpdf_sertifprestasi', ['id' => $item->id]) }}" target="_blank">Sertif Prestasi{{ $item->id }}</a>                            
                            </td>
                            <td>
                                {{ $item->status_pres }}
                            </td>
                            <td>
                                {{ $item->status_org }}
                            </td>
                            <td>{{ $item->da_nilai_wawancara }}</td>
                            <td>{{ $item->ide_project }}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Checked</span>
                                @elseif($item->status == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </td>
                            @if (Auth::check() && Auth::user()->name === 'aslab ai')
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="d-flex">
                                        <form id="approveForm_{{ $item->da_nama }}" action="{{ url('update_status/'.$item->da_nama.'/'.$item->da_lab) }}" method="post" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-sm btn-success approveBtn" data-nama="{{ $item->da_nama }}">                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form id="rejectForm_{{ $item->da_nama }}" action="{{ url('update_status/'. $item->da_nama.'/'.$item->da_lab) }}" method="post" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class="btn btn-sm btn-danger rejectBtn" data-nama="{{ $item->da_nama }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="d-flex">
                                        <a href='{{ url('admin/'.$item->da_nim.'/'.$item->da_lab.'/edit_da') }}' class="btn btn-warning btn-sm">Edit</a>
                                        <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->da_nama.'/'.$item->da_lab.'/del_calon') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                        </form>
                                    </div>

                            </div>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        @foreach($data_lab_ai as $item)
                            if ("{{ $item->status }}" == "2") {
                                document.querySelectorAll('.approveBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                    btn.style.display = 'none';
                                });
                                document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                    btn.style.display = 'none';
                                });                            
                            }
                            document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                btn.closest('form').addEventListener('submit', function(event) {
                                    event.preventDefault();  // Prevent the default form submission
                                    document.querySelectorAll('.approveBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                        btn.style.display = 'none';
                                    });
                                    document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                        btn.style.display = 'none';
                                    });
                                    this.submit();  // Submit the form programmatically
                                });
                            });
                        @endforeach
                    });
                </script>
                {{ $data_lab_ai->links() }}
            </div>
        </div>
        @elseif (Auth::check() && Auth::user()->name === 'aslab it')
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
                            <th class="">KHS</th>
                            <th class="">Nilai SO</th>
                            <th class="">Nilai Jarkom</th>
                            <th class="">Nilai DMJ</th>
                            <th class="">Nilai RNS</th>
                            <th class="">Pengalaman</th>
                            <th class="">Nilai Tes</th>
                            <th class="">K.Mengajar</th>
                            <th class="">K.Probsolv</th>
                            <th class="">K.TimeMj</th>
                            <th class="">Status</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data_lab_it as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->da_nim }}</td>
                            <td>{{ $item->da_nama }}</td>
                            <td>
                                <a href="{{ route('showpdf_khs', ['id' => $item->id]) }}" target="_blank">KHS</a>                            
                            </td>
                            <td>{{ $item->itnilai_sop }}</td>
                            <td>{{ $item->itnilai_jarkom}}</td>
                            <td>{{ $item->itnilai_dmj }}</td>
                            <td>{{ $item->itnilai_rns }}</td>
                            <td>
                                {{ $item->da_organisasi }}
                            </td>
                            <td>{{ $item->da_nilai_tulis }}</td>
                            <td>{{ $item->itnilai_mengajar }}</td>
                            <td>{{ $item->itnilai_probsolv }}</td>
                            <td>{{ $item->itnilai_timemj }}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Checked</span>
                                @elseif($item->status == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="d-flex">
                                        <form id="approveForm_{{ $item->da_nama }}" action="{{ url('update_status/'.$item->da_nama.'/'.$item->da_lab) }}" method="post" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-sm btn-success approveBtn" data-nama="{{ $item->da_nama }}">                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form id="rejectForm_{{ $item->da_nama }}" action="{{ url('update_status/'. $item->da_nama.'/'.$item->da_lab) }}" method="post" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class="btn btn-sm btn-danger rejectBtn" data-nama="{{ $item->da_nama }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="d-flex">
                                        <a href='{{ url('admin/'.$item->da_nim.'/'.$item->da_lab.'/edit_da') }}' class="btn btn-warning btn-sm">Edit</a>
                                        <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->da_nama.'/'.$item->da_lab.'/del_calon') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                        </form>
                                    </div>

                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        @foreach($data_lab_it as $item)
                            if ("{{ $item->status }}" == "2") {
                                document.querySelectorAll('.approveBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                    btn.style.display = 'none';
                                });
                                document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                    btn.style.display = 'none';
                                });                            
                            }
                            document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                btn.closest('form').addEventListener('submit', function(event) {
                                    event.preventDefault();  // Prevent the default form submission
                                    document.querySelectorAll('.approveBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                        btn.style.display = 'none';
                                    });
                                    document.querySelectorAll('.rejectBtn[data-nama="{{ $item->da_nama }}"]').forEach(function(btn) {
                                        btn.style.display = 'none';
                                    });
                                    this.submit();  // Submit the form programmatically
                                });
                            });
                        @endforeach
                    });
                </script>
                {{ $data_lab_it->links() }}
            </div>
        </div>
        @endif




        


          <!-- AKHIR DATA -->
          
@endsection