@extends('template.template')
@extends('template.sidebaradmin')

@section('konten')
        <!-- START FORM -->

<form action='{{ url('store_kriteria') }}' method='post'>
@csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="lab" class="col-sm-2 col-form-label">Pilih Laboratorium</label>
            <div class="col-sm-10">
                
                <select name="lab" id="lab" class="form-control">
                    <option value="">Pilih Laboratorium</option>
                    @foreach ($nama_lab as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='kriteria' id="kriteria">
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
    </div>
</form>
    <!-- AKHIR FORM -->
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                @if (Auth::check() && Auth::user()->name === 'aslab pc' || Auth::user()->name === 'kalab pertanian cerdas')
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Laboratorium</th>
                            <th class="col-md-3">Nama Kriteria</th>
                            <th class="col-md-1">Bobot</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lab_pc as $index => $item)
                            
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->lab }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->kriteria.'/edit_kriteria') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->kriteria.'/del_kriteria') }}" method="post">
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
                @elseif (Auth::check() && Auth::user()->name === 'aslab ai' || Auth::user()->name === 'kalab artificial intelligence' )
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Laboratorium</th>
                            <th class="col-md-3">Nama Kriteria</th>
                            <th class="col-md-1">Bobot</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lab_ai as $index => $item)
                            
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->lab }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->kriteria.'/edit_kriteria') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->kriteria.'/del_kriteria') }}" method="post">
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
                @elseif (Auth::check() && Auth::user()->name === 'aslab it' || Auth::user()->name === 'kalab infrastruktur teknologi' )
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Laboratorium</th>
                            <th class="col-md-3">Nama Kriteria</th>
                            <th class="col-md-1">Bobot</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lab_it as $index => $item)
                            
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->lab }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->kriteria.'/edit_kriteria') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->kriteria.'/del_kriteria') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data_lab_it->links() }}
                @elseif (Auth::check() && Auth::user()->name === 'aslab rpl' || Auth::user()->name === 'kalab rekayasa perangkat lunak' )
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Laboratorium</th>
                            <th class="col-md-3">Nama Kriteria</th>
                            <th class="col-md-1">Bobot</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lab_rpl as $index => $item)
                            
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->lab }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->kriteria.'/edit_kriteria') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->kriteria.'/del_kriteria') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data_lab_rpl->links() }}

                @endif

          </div>
          <!-- AKHIR DATA -->
@endsection