@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')
    <!-- START FORM -->
<form action='{{ url('store_sub') }}' method='post'>
@csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
            <div class="col-sm-10">
                @if (Auth::check() && Auth::user()->name === 'aslab pc')
                <select name="kriteria" id="kriteria" class="form-control">
                    <option disable selected>Pilih Kriteria</option>
                    @foreach ($krit_pc as $kriteria)
                    <option value="{{ $kriteria }}">{{ $kriteria }}</option>
                    @endforeach
                </select>
                @elseif (Auth::check() && Auth::user()->name === 'aslab ai')
                <select name="kriteria" id="kriteria" class="form-control">
                    <option disable selected>Pilih Kriteria</option>
                    @foreach ($krit_ai as $kriteria)
                    <option value="{{ $kriteria }}">{{ $kriteria }}</option>
                    @endforeach
                </select>
                @elseif(Auth::check() && Auth::user()->name === 'aslab it')
                <select name="kriteria" id="kriteria" class="form-control">
                    <option disable selected>Pilih Kriteria</option>
                    @foreach ($krit_it as $kriteria)
                    <option value="{{ $kriteria }}">{{ $kriteria }}</option>
                    @endforeach
                </select>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="subkriteria" class="col-sm-2 col-form-label">Keterangan Subkriteria</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='subkriteria' value="{{ $subkriteria }}" id="subkriteria">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nilai" class="col-sm-2 col-form-label">Nilai</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nilai' id="nilai">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if (Auth::check() && Auth::user()->name === 'aslab pc')
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="">Laboratorium</th>
                            <th class="">Kriteria</th>
                            <th class="">Keterangan Subkriteria</th>
                            <th class="">Nilai</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lab_pc as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->s_lab }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>>{{ $item->subkriteria }}</td>
                            <td>{{ $item->nilai }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->id.'/edit_sub') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->subkriteria.'/del_sub') }}" method="post">
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
                @elseif (Auth::check() && Auth::user()->name === 'aslab ai')
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="">Laboratorium</th>
                            <th class="">Kriteria</th>
                            <th class="">Keterangan Subkriteria</th>
                            <th class="">Nilai</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lab_ai as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->s_lab }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>>{{ $item->subkriteria }}</td>
                            <td>{{ $item->nilai }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->id.'/edit_sub') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->subkriteria.'/del_sub') }}" method="post">
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
                @elseif(Auth::check() && Auth::user()->name === 'aslab it')
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="">Laboratorium</th>
                            <th class="">Kriteria</th>
                            <th class="">Keterangan Subkriteria</th>
                            <th class="">Nilai</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lab_it as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->s_lab }}</td>
                            <td>{{ $item->kriteria }}</td>
                            <td>>{{ $item->subkriteria }}</td>
                            <td>{{ $item->nilai }}</td>
                            <td>
                                <a href='{{ url('admin/'.$item->id.'/edit_sub') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="d-inline" action=" {{ url('admin/'.$item->subkriteria.'/del_sub') }}" method="post">
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

                @endif
          </div>
@endsection