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
                    <label for="sertif_lomba" class="col-sm-2 col-form-label">Upload Sertifikat Lomba</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name='sertif_lomba[]' id="sertif_lomba" multiple accept=".pdf">
                        <div id="file-preview"></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="pengalaman" class="col-sm-2 col-form-label">Pengalaman</label>
                    <div class="col-sm-10" id="pengalaman-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="pengalaman[]" id="pengalaman">
                            <button type="button" class="btn btn-success add-pengalaman">Add</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="link_project" class="col-sm-2 col-form-label">Link Portofolio Project</label>
                    <div class="col-sm-10" id="idea-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="link_project[]" id="link_project">
                            <button type="button" class="btn btn-success add-idea">Add</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_matkul_ppla" class="col-sm-2 col-form-label">Nilai Mata Kuliah PPL Agro</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_matkul_ppla' id="nilai_matkulx">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_matkul_sd" class="col-sm-2 col-form-label">Nilai Mata Kuliah Sistem Digital</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_matkul_sd' id="nilai_matkuly">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_matkul_ppa" class="col-sm-2 col-form-label">Nilai Mata Kuliah PAA</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_matkul_paa' id="nilai_matkulz">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggung_jawab" class="col-sm-2 col-form-label">Bagaimana bentuk tanggung jawab anda (ganti dengan pertanyaan asli)</label>
                    <div class="col-sm-10" id="idea-container">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tanggung_jawab" id="ya" value="Ya" required>
                            <label class="form-check-label" for="ya">
                                Ya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tanggung_jawab" id="tidak" value="Tidak" required>
                            <label class="form-check-label" for="tidak">
                                Tidak
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tanggung_jawab" id="mungkin" value="Mungkin" required>
                            <label class="form-check-label" for="mungkin">
                                Mungkin
                            </label>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        document.querySelector('.add-idea').addEventListener('click', function() {
                            // Create a new input group
                            const inputGroup = document.createElement('div');
                            inputGroup.className = 'input-group mb-2';
                            
                            // Create a new input element
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.name = 'link_project[]';
                            input.className = 'form-control';
                            
                            // Create a remove button
                            const removeButton = document.createElement('button');
                            removeButton.type = 'button';
                            removeButton.className = 'btn btn-danger remove-idea';
                            removeButton.textContent = 'Remove';
                
                            // Append the input and remove button to the input group
                            inputGroup.appendChild(input);
                            inputGroup.appendChild(removeButton);
                
                            // Append the input group to the container
                            document.getElementById('idea-container').appendChild(inputGroup);
                        });
                
                        // Event delegation to handle removal of ideas
                        document.getElementById('idea-container').addEventListener('click', function(e) {
                            if (e.target && e.target.classList.contains('remove-idea')) {
                                e.target.parentElement.remove();
                            }
                        });
                    });
                </script>     
                
                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        document.querySelector('.add-pengalaman').addEventListener('click', function() {
                            // Create a new input group
                            const inputGroup = document.createElement('div');
                            inputGroup.className = 'input-group mb-2';
                            
                            // Create a new input element
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.name = 'pengalaman[]';
                            input.className = 'form-control';
                            
                            // Create a remove button
                            const removeButton = document.createElement('button');
                            removeButton.type = 'button';
                            removeButton.className = 'btn btn-danger remove-pengalaman';
                            removeButton.textContent = 'Remove';
                
                            // Append the input and remove button to the input group
                            inputGroup.appendChild(input);
                            inputGroup.appendChild(removeButton);
                
                            // Append the input group to the container
                            document.getElementById('pengalaman-container').appendChild(inputGroup);
                        });
                
                        // Event delegation to handle removal of ideas
                        document.getElementById('pengalaman-container').addEventListener('click', function(e) {
                            if (e.target && e.target.classList.contains('remove-pengalaman')) {
                                e.target.parentElement.remove();
                            }
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