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
                  <p class="teks1">Mahasiswa</p>
                  <div class="kotak2">
                    <div class="kotak3">
                        <p class="teks2">Selamat datang, Mahasiswa. Ini adalah aplikasi pengambilan metode keputusan dengan metode SMART (Simple Multi Attribute Rating Technique) </p>
                    </div>
                  </div>
                </div>
    </div>
    <!-- /.container-fluid -->
</div>

<div class="container">
    <div class="row">
      <div class="col-lg-4 mb-4"> <!-- Adjust column width as needed (e.g., col-lg-4, col-md-6, etc.) -->
        <div class="card h-100">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Laboratorium Pertanian Cerdas</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <!-- Button to open the modal -->
            <button type="button" class="btn btn-primary" id="fetchDataButton" data-bs-toggle="modal" data-bs-target="#detailsModal">
                Daftar
            </button>
  
          </div>
        </div>
      </div>
  
      <!-- Add more similar columns as needed -->
      
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <img src="{{ asset('logo/LOGO INFRATEK.png') }}" class="card-img-top" alt="logo infratek">
          <div class="card-body">
            <h5 class="card-title">Laboratorium Infrastruktur Teknologi</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <button type="button" class="btn btn-primary" id="fetchDataButton" data-bs-toggle="modal" data-bs-target="#detailsModal">
                Daftar
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <img src="{{ asset('LOGO INFRATEK.png') }}" class="card-img-top" alt="logo infratek">
          <div class="card-body">
            <h5 class="card-title">Laboratorium Artificial Intelligence</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <button type="button" class="btn btn-primary" id="fetchDataButton" data-bs-toggle="modal" data-bs-target="#detailsModal">
                Daftar
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <img src="{{ asset('logo/LOGO INFRATEK.png') }}" class="card-img-top" alt="logo infratek">
          <div class="card-body">
            <h5 class="card-title">Laboratorium Rekayasa Perangkat Lunak</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <button type="button" class="btn btn-primary" id="fetchDataButton" data-bs-toggle="modal" data-bs-target="#detailsModal">
                Daftar
            </button>
          </div>
        </div>
      </div>
  
      <!-- Add more similar columns as needed -->
      
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Details content -->
          <form action='' method='post'>
            @csrf
            @method('PUT')
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
                        <input type="text" class="form-control" name='nama' id="nama"  aria-label="readonly input example" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='prodi' id="prodi" aria-label="readonly input example" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='ipk' id="ipk" aria-label="readonly input example" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lab" class="col-sm-2 col-form-label">Pilih Laboratorium</label>
                    <div class="col-sm-10">
                        
                        <select name="lab" id="lab" class="form-control">
                                <option disable selected>Pilih Laboratorium</option>
                                @if(isset($distinct_nama_lab) && count($distinct_nama_lab) > 0)
                                @foreach ($distinct_nama_lab as $nama_lab)
                                <option value="{{ $nama_lab }}">{{ $nama_lab }}</option>
                                @endforeach
                                @else
                                    <p>No distinct lab names found.</p>
                                @endif
                        </select>
                        
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sp" class="col-sm-2 col-form-label">Upload Sertifikat Prestasi</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name='sp[]' id="sp" multiple>
                        <div id="file-preview"></div>
                    </div>
                </div>

                {{-- SCRIPT UNTUK PREVIEW FILE SBLM DIUPLOAD --}}
                {{-- <script>
                    // Function to display selected files in the preview area
                    document.getElementById('so').addEventListener('change', function(event) {
                        const previewArea = document.getElementById('file-preview');
                        previewArea.innerHTML = ''; // Clear previous previews
                        
                        const files = event.target.files;
                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const fileReader = new FileReader();
                            fileReader.onload = function() {
                                const filePreview = document.createElement('div');
                                filePreview.textContent = file.name;
                                previewArea.appendChild(filePreview);
                            };
                            fileReader.readAsDataURL(file);
                        }
                    });
                </script> --}}

                <div class="mb-3 row">
                    <label for="so" class="col-sm-2 col-form-label">Upload Sertifikat Organisasi/Kepanitiaan</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name='so[]' id="so" multiple>
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
        </div>
      </div>
    </div>
  </div>
  <script>
    // Attach click event listener to the button
    document.getElementById('fetchDataButton').addEventListener('click', function() {
        // Send AJAX request to fetch data from the server
        fetch('mahasiswa.dashMahasiswa')
            .then(response => response.text())
            .then(data => {
                // Update modal content with fetched data
                document.querySelector('.modal-body').innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
</script>

@endsection