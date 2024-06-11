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
                        <label for="lab" class="col-sm-2 col-form-label">Laboratorium</label>
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
                        <label for="portofolio" class="col-sm-2 col-form-label">Upload Portofolio</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name='portofolio[]' id="portofolio" multiple accept=".pdf">
                            <div id="file-preview"></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="div1" class="col-sm-2 col-form-label">Pilihan Divisi 1</label>
                        <div class="col-sm-10">
                            <select name="div1" id="div1" class="form-control">
                                <option disable selected>Pilih Divisi</option>
                                <option value="Asisten Praktikum (Perancangan)">Asisten Praktikum (Perancangan)</option>
                                <option value="Asisten Praktikum (Pengembangan)">Asisten Praktikum (Pengembangan)</option>
                                <option value="Asisten Penelitian (Perancangan)">Asisten Penelitian (Perancangan)</option>
                                <option value="Asisten Penelitian (Pengembangan)">Asisten Penelitian (Pengembangan)</option>
                                <option value="Media Kreatif">Media Kreatif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="div2" class="col-sm-2 col-form-label">Pilihan Divisi 2</label>
                        <div class="col-sm-10">
                            <select name="div2" id="div2" class="form-control">
                                <option disable selected>Pilih Divisi</option>
                                <option value="Asisten Praktikum (Perancangan)">Asisten Praktikum (Perancangan)</option>
                                <option value="Asisten Praktikum (Pengembangan)">Asisten Praktikum (Pengembangan)</option>
                                <option value="Asisten Penelitian (Perancangan)">Asisten Penelitian (Perancangan)</option>
                                <option value="Asisten Penelitian (Pengembangan)">Asisten Penelitian (Pengembangan)</option>
                                <option value="Media Kreatif">Media Kreatif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pertanyaan_divisi" class="col-sm-2 col-form-label">Apakah bersedia untuk ditugaskan di divisi yang tidak anda pilih?</label>
                        <div class="col-sm-10">
                            <select name="pertanyaan_divisi" id="pertanyaan_divisi" class="form-control">
                                <option disable selected>Pilih Opsi</option>
                                <option value="Ya">Ya</option>
                                <option value="Mungkin">Mungkin</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mbkm" class="col-sm-2 col-form-label">Kegiatan MBKM apa yang telah atau sedang diikuti? (Untuk angkatan 21)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='mbkm' id="mbkm">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nilai_algo1" class="col-sm-2 col-form-label">Nilai Algo 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='nilai_algo1' id="nilai_algo1">
                        </div>
                    </div>

                <div class="mb-3 row">
                    <label for="nilai_pbo" class="col-sm-2 col-form-label">Nilai PBO</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_pbo' id="nilai_pbo">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_sql" class="col-sm-2 col-form-label">Nilai SQL</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_sql' id="nilai_sql">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_pweb" class="col-sm-2 col-form-label">Nilai PWEB</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_pweb' id="nilai_pweb">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_uiux" class="col-sm-2 col-form-label">Nilai UIUX</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_uiux' id="nilai_uiux">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_ood" class="col-sm-2 col-form-label">Nilai OOD</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_ood' id="nilai_ood">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_algo2" class="col-sm-2 col-form-label">Nilai ALGO2</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_algo2' id="nilai_algo2">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_paa" class="col-sm-2 col-form-label">Nilai PAA</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_paa' id="nilai_paa">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_pmobile" class="col-sm-2 col-form-label">Nilai PMOBILE</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_pmobile' id="nilai_pmobile">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_sbd" class="col-sm-2 col-form-label">Nilai SBD</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_sbd' id="nilai_sbd">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_tkti" class="col-sm-2 col-form-label">Nilai TKTI</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_tkti' id="nilai_tkti">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_adpl" class="col-sm-2 col-form-label">Nilai ADPL</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_adpl' id="nilai_adpl">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_mpti" class="col-sm-2 col-form-label">Nilai MPTI</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_mpti' id="nilai_mpti">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nilai_ppla" class="col-sm-2 col-form-label">Nilai PPLA</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nilai_ppla' id="nilai_ppla">
                    </div>
                </div>
            
                <div class="mb-3 row">
                    <label for="submit" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></div>
                </div>
              </form>
            </div>
@endsection