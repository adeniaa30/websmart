@extends('template.sidebarmhs')
@extends('template.template')

@section('konten')
    <!-- START FORM -->
          <form action='{{ url('submitform') }}' method='post' enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='nim' id="nim" value="{{ $nim }}" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='nama' id="nama" value="{{ $nama }}" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='prodi' id="prodi" value="{{ $prodi}}" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='ipk' id="ipk" value="{{ $ipk }}" aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="lab" class="col-sm-2 col-form-label">Pilih Laboratorium</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='lab' id="lab" value="{{ $lab }}" aria-label="readonly input example" readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="khs" class="col-sm-2 col-form-label">Upload KHS</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name='khs' id="khs" accept=".pdf">
                            <div id="file-preview"></div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="organisasi" class="col-sm-2 col-form-label">Pengalaman/Capaian (dengan tahun)</label>
                        <div class="col-sm-10" id="organisasi-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="organisasi[]" id="organisasi">
                                <button type="button" class="btn btn-success add-organisasi">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nilai_sop" class="col-sm-2 col-form-label">Nilai Matkul Sistem Operasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='nilai_sop' id="nilai_sop">
                        </div>
                    </div>

                <div class="mb-3 row">
                    <label for="nilai_jarkom" class="col-sm-2 col-form-label">Nilai Matkul Jaringan Komputer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_jarkom' id="nilai_jarkom">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_dmj" class="col-sm-2 col-form-label">Nilai Matkul Desain Manajemen Jaringan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_dmj' id="nilai_dmj">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_rns" class="col-sm-2 col-form-label">Nilai Matkul Routing & Switching</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_rns' id="nilai_rns">
                    </div>
                </div>


                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        document.querySelector('.add-organisasi').addEventListener('click', function () {
                            const container = document.getElementById('organisasi-container');
                            const newInputGroup = document.createElement('div');
                            newInputGroup.className = 'input-group mb-2';
                            newInputGroup.innerHTML = `
                                <input type="text" class="form-control" name="organisasi[]">
                                <button type="button" class="btn btn-danger remove-organisasi">Remove</button>
                            `;
                            container.appendChild(newInputGroup);

                            newInputGroup.querySelector('.remove-organisasi').addEventListener('click', function () {
                                container.removeChild(newInputGroup);
                            });
                        });
                    });                
                </script>                
            
                <div class="mb-3 row">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
                </div>
              </form>
            </div>
@endsection