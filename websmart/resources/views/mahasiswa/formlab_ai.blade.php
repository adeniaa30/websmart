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
                            <div id="input-container">
                                <div class="input-group mb-2">
                                    <input type="file" class="form-control" name='sertif_lomba[]' id="sertif_lomba" multiple accept=".pdf">
                                    <div id="file-preview"></div>
                                    <select name="status_prestasi[]" id="status_prestasi" class="form-control">
                                        <option disabled selected>Status Sertifikat</option>
                                        <option value="Sebagai Peserta">Sebagai Peserta</option>
                                        <option value="Berperingkat">Berperingkat</option>
                                    </select>
                                    <button type="button" class="btn btn-success add-button">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="mb-3 row">
                    <label for="so" class="col-sm-2 col-form-label">Organisasi Yang Diikuti</label>
                    <div class="col-sm-10" id="organisasi-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="organisasi[]" id="organisasi">
                            <select name="status_organisasi[]" id="status_organisasi" class="form-control">
                                <option disabled selected>Status Keanggotaan</option>
                                <option value="Sebagai Pengurus">Sebagai Pengurus</option>
                                <option value="Bukan Pengurus">Bukan Pengurus</option>
                            </select>
                            <button type="button" class="btn btn-success" id="add-organisasi">Add</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_keckom" class="col-sm-2 col-form-label">Nilai Matkul Kecerdasan Komputasional</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_keckom' id="nilai_keckom">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_kb" class="col-sm-2 col-form-label">Nilai Matkul Kecerdasan Buatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_kb' id="nilai_kb">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_pkb" class="col-sm-2 col-form-label">Nilai Matkul Pengantar Kecerdasan Buatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_pkb' id="nilai_pkb">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_datmin" class="col-sm-2 col-form-label">Nilai Matkul Data Mining</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_datmin' id="nilai_datmin">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="ide" class="col-sm-2 col-form-label">Kontribusi Ide Project</label>
                    <div class="col-sm-10" id="idea-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="ide[]" id="ide">
                            <button type="button" class="btn btn-success add-idea">Add</button>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const container = document.getElementById('input-container');
                    
                        container.addEventListener('click', function(event) {
                            if (event.target && event.target.matches('.add-button')) {
                                const newInputGroup = document.createElement('div');
                                newInputGroup.classList.add('input-group', 'mb-2');
                    
                                newInputGroup.innerHTML = `
                                    <input type="file" class="form-control" name='sertif_lomba[]' multiple accept=".pdf">
                                    <select name="status_prestasi[]" class="form-control">
                                        <option disabled selected>Status Sertifikat</option>
                                        <option value="Sebagai Peserta">Sebagai Peserta</option>
                                        <option value="Berperingkat">Berperingkat</option>
                                    </select>
                                    <button type="button" class="btn btn-danger remove-button">Remove</button>
                                `;
                    
                                container.appendChild(newInputGroup);
                            }
                    
                            if (event.target && event.target.matches('.remove-button')) {
                                event.target.closest('.input-group').remove();
                            }
                        });
                    });
                    </script>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        document.getElementById('add-organisasi').addEventListener('click', function () {
                            // Get the container where we will append new fields
                            var container = document.getElementById('organisasi-container');
                
                            // Create a new div element for the input group
                            var newInputGroup = document.createElement('div');
                            newInputGroup.classList.add('input-group', 'mb-2');
                
                            // Create the new input field
                            var newInput = document.createElement('input');
                            newInput.type = 'text';
                            newInput.classList.add('form-control');
                            newInput.name = 'organisasi[]';
                
                            // Create the new dropdown
                            var newSelect = document.createElement('select');
                            newSelect.name = 'status_organisasi[]';
                            newSelect.classList.add('form-control');
                
                            // Create the options for the dropdown
                            var optionDefault = document.createElement('option');
                            optionDefault.disabled = true;
                            optionDefault.selected = true;
                            optionDefault.text = 'Status Keanggotaan';
                
                            var optionPengurus = document.createElement('option');
                            optionPengurus.value = 'Sebagai Pengurus';
                            optionPengurus.text = 'Sebagai Pengurus';
                
                            var optionNonPengurus = document.createElement('option');
                            optionNonPengurus.value = 'Bukan Pengurus';
                            optionNonPengurus.text = 'Bukan Pengurus';
                
                            // Append options to the select element
                            newSelect.appendChild(optionDefault);
                            newSelect.appendChild(optionPengurus);
                            newSelect.appendChild(optionNonPengurus);

                            // Create the remove button
                            var removeButton = document.createElement('button');
                            removeButton.type = 'button';
                            removeButton.classList.add('btn', 'btn-danger', 'remove-idea');
                            removeButton.textContent = 'Remove';
                
                            // Append input and select and remove to the new input group
                            newInputGroup.appendChild(newInput);
                            newInputGroup.appendChild(newSelect);
                            newInputGroup.appendChild(removeButton);
                
                            // Append the new input group to the container
                            container.appendChild(newInputGroup);

                            // Add event listener to the remove button
                            removeButton.addEventListener('click', function () {
                                container.removeChild(newInputGroup);
                            });
                        });
                    });
                </script>

                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        document.querySelector('.add-idea').addEventListener('click', function() {
                            // Create a new input group
                            const inputGroup = document.createElement('div');
                            inputGroup.className = 'input-group mb-2';
                            
                            // Create a new input element
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.name = 'ide[]';
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
            
                <div class="mb-3 row">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
                </div>
              </form>
            </div>
@endsection