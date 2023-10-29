@extends('template.sidebar')
@extends('template.template')

@section('konten')
    <!-- START FORM -->
<form action='' method='post'>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <select name="nama" id="nama" class="form-control">
                    <option disable selected>Pilih Nama</option>
                    <option value="nama1">Nama 1</option>
                    <option value="nama1">Nama 2</option>
                    <option value="nama1">Nama 3</option>
                    <option value="nama1">Nama 4</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nilai_ipk" class="col-sm-2 col-form-label">Nilai IPK</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nilai_ipk' id="nilai_ipk">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nilai_sp" class="col-sm-2 col-form-label">Nilai Sertif Prestasi/Porto</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nilai_sp' id="nilai_sp">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nilai_so" class="col-sm-2 col-form-label">Nilai Sertif Organisasi</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nilai_so' id="nilai_so">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nilai_testulis" class="col-sm-2 col-form-label">Nilai Tes Tulis</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nilai_testulis' id="nilai_testulis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nilai_wawancara" class="col-sm-2 col-form-label">Nilai Wawancara</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nilai_wawancara' id="nilai_wawancara">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nilai_matkul" class="col-sm-2 col-form-label">Nilai Matkul</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nilai_matkul' id="nilai_matkul">
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
                            <th class="">Nama</th>
                            <th class="">Nilai IPK</th>
                            <th class="">Nilai Sertif Prestasi/Porto</th>
                            <th class="">Nilai Tes Tulis</th>
                            <th class="">Nilai Tes Wawancara</th>
                            <th class="">Nilai Matkul</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nurul Hapsari Adenia</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>90</td>
                            <td>
                                <a href='' class="btn btn-warning btn-sm">Edit</a>
                                <a href='' class="btn btn-danger btn-sm">Del</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
          </div>
@endsection