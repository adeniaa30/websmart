@extends('template.sidebaradmin')
@extends('template.template')

@section('konten')
    <!-- START FORM -->
<form action='' method='post'>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
            <div class="col-sm-10">
                <select name="kriteria" id="kriteria" class="form-control">
                    <option disable selected>Pilih Kriteria</option>
                    <option value="ipk">IPK</option>
                    <option value="prestasi">Prestasi/Portofolio</option>
                    <option value="organisasi">Pengalaman Organisasi</option>
                    <option value="matkul">Nilai Mata Kuliah</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Keterangan Subkriteria</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='subkriteria' id="subkriteria">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nilai</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nilai_subkriteria' id="nilai_subkriteria">
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">No</th>
                            <th class="">Kriteria</th>
                            <th class="">Keterangan Subkriteria</th>
                            <th class="">Nilai</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>IPK</td>
                            <td>>5</td>
                            <td>120</td>
                            <td>
                                <a href='' class="btn btn-warning btn-sm">Edit</a>
                                <a href='' class="btn btn-danger btn-sm">Del</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
          </div>
@endsection