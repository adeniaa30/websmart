@extends('template.sidebar')
@extends('template.template')

@section('konten')
    <!-- START FORM -->
<form action='' method='post'>
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
        {{-- <div class="mb-3 row">
            <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-10">
                <select name="prodi" id="prodi" class="form-control">
                    <option disable selected>Pilih Program Studi</option>
                    <option value="si">Sistem Informasi</option>
                    <option value="ti">Teknologi Informasi</option>
                    <option value="if">Informatika</option>
                </select>
            </div>
        </div> --}}
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                {{-- <div class="pb-3">
                  <form class="d-flex" action="" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div> --}}
                
                <!-- TOMBOL TAMBAH DATA -->
                {{-- <div class="pb-3">
                  <a href='' class="btn btn-primary">+ Tambah Data</a>
                </div> --}}
          
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
                        <tr>
                            <td>1</td>
                            <td>192410102073</td>
                            <td>Nurul Hapsari Adenia</td>
                            <td>Teknologi Informasi</td>
                            <td>4.00</td>
                            <td>
                                <a href='' class="btn btn-warning btn-sm">Tambahkan Mahasiswa</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
          </div>
          <!-- AKHIR DATA -->
          <form action='' method='post'>
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nim' id="nim" value="Readonly NIM" aria-label="readonly input example" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama' id="nama" value="Readonly NAMA" aria-label="readonly input example" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='prodi' id="prodi" value="Readonly PRODI" aria-label="readonly input example" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='ipk' id="ipk" value="Readonly IPK" aria-label="readonly input example" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sp" class="col-sm-2 col-form-label">Upload Sertifikat Prestasi</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name='sp' id="sp">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="so" class="col-sm-2 col-form-label">Upload Sertifikat Organisasi/Kepanitiaan</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name='so' id="so">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="testulis" class="col-sm-2 col-form-label">Nilai Tes Tulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='testulis' id="testulis">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="teswawancara" class="col-sm-2 col-form-label">Nilai Tes Wawancara</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='teswawancara' id="teswawancara">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
                </div>
              </form>
            </div>
@endsection