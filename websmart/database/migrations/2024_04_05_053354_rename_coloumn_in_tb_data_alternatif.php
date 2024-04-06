<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->string('da_nim')->after('nim');
            $table->string('da_nama')->after('nama');
            $table->string('da_prodi')->after('prodi');
            $table->float('da_ipk')->after('ipk');
            $table->string('da_lab')->after('lab');
            $table->binary('da_sertif_prestasi')->after('sertif_prestasi');
            $table->binary('da_sertif_organisasi')->after('sertif_organisasi');
            $table->integer('da_nilai_tulis')->after('nilai_tulis');
            $table->integer('da_nilai_wawancara')->after('nilai_wawancara');
            // $table->renameColumn('nim','da_nim');
            // $table->renameColumn('nama','da_nama');
            // $table->renameColumn('prodi','da_prodi');
            // $table->renameColumn('ipk','da_ipk');
            // $table->renameColumn('lab','da_lab');
            // $table->renameColumn('sertif_prestasi','da_sertif_prestasi');
            // $table->renameColumn('sertif_organisasi','da_sertif_organisasi');
            // $table->renameColumn('nilai_tulis','da_nilai_tulis');
            // $table->renameColumn('nilai_wawancara','da_nilai_wawancara');
        });
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropColumn('nim');
            $table->dropColumn('nama');
            $table->dropColumn('prodi');
            $table->dropColumn('ipk');
            $table->dropColumn('lab');
            $table->dropColumn('sertif_prestasi');
            $table->dropColumn('sertif_organisasi');
            $table->dropColumn('nilai_tulis');
            $table->dropColumn('nilai_wawancara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->string('nim')->after('da_nim');
            $table->string('nama')->after('da_nama');
            $table->string('prodi')->after('da_prodi');
            $table->float('ipk')->after('da_ipk');
            $table->string('lab')->after('da_lab');
            $table->binary('sertif_prestasi')->after('da_sertif_prestasi');
            $table->binary('sertif_organisasi')->after('da_sertif_organisasi');
            $table->integer('nilai_tulis')->after('da_nilai_tulis');
            $table->integer('nilai_wawancara')->after('da_nilai_wawancara');
            // $table->renameColumn('da_nim','nim');
            // $table->renameColumn('da_nama','nama');
            // $table->renameColumn('da_prodi','prodi');
            // $table->renameColumn('da_ipk','ipk');
            // $table->renameColumn('da_lab','lab');
            // $table->renameColumn('da_sertif_prestasi','sertif_prestasi');
            // $table->renameColumn('da_sertif_organisasi','sertif_organisasi');
            // $table->renameColumn('da_nilai_tulis','nilai_tulis');
            // $table->renameColumn('da_nilai_wawancara','nilai_wawancara');
        });
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropColumn('da_nim');
            $table->dropColumn('da_nama');
            $table->dropColumn('da_prodi');
            $table->dropColumn('da_ipk');
            $table->dropColumn('da_lab');
            $table->dropColumn('da_sertif_prestasi');
            $table->dropColumn('da_sertif_organisasi');
            $table->dropColumn('da_nilai_tulis');
            $table->dropColumn('da_nilai_wawancara');
        });
    }
};
