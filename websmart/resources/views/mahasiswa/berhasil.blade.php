@extends('template.sidebarmhs')
@extends('template.template')

<html>
    <link rel="stylesheet" href="css/web.css">
</html>

@section('konten')

<div id="page-wrapper">
  <div class="container-fluid">
          <div class="">
              <h1 class="page-header">Hi...</h1>
          </div>
          
              <div class="kotak">
                <p class="teks1">Terima Kasih Sudah Mendaftar</p>
                <div class="kotak2">
                  <div class="kotak3">
                      <p class="teks2">
                        Silahkan menunggu hasil seleksi dan anda dapat melihatnya pada halaman Dasboard. Have a nice day :)
                      </p>
                  </div>
                </div>
              </div>
  </div>
  <!-- /.container-fluid -->
</div>
{{-- <div id="page-wrapper">
    <div class="container-fluid">
            <div class="">
                <h1 class="page-header">Silahkan Mengakses Link di Bawah Ini Untuk Screening Test Laboratorium Infrastruktur Teknologi</h1>
            </div>
            
                <div class="kotak">
                  <div class="kotak2">
                    <div class="kotak3">
                    </div>
                  </div>
                </div>
    </div> --}}

@endsection