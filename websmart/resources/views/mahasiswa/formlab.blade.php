@extends('template.sidebarmhs')
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
                    <label for="lab" class="col-sm-2 col-form-label">Pilih Laboratorium</label>
                    <div class="col-sm-10">
                        <select name="lab" id="lab" class="form-control">
                            <option disable selected>Pilih Laboratorium</option>
                            <option value="lab1">Lab 1</option>
                            <option value="lab2">Lab 2</option>
                            <option value="lab3">Lab 3</option>
                            <option value="lab4">Lab 4</option>
                            <option value="lab5">Lab 5</option>
                        </select>
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
                    <label for="alasan" class="col-sm-2 col-form-label">Alasan Mendaftar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='alasan' id="alasan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="motivasi" class="col-sm-2 col-form-label">Motivasi Mendaftar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='motivasi' id="motivasi">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
                </div>
              </form>
            </div>
@endsection