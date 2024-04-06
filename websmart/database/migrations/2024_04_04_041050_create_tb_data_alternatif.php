<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_data_alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('prodi');
            $table->float('ipk');
            $table->string('lab');
            $table->binary('sertif_prestasi');
            $table->binary('sertif_organisasi');
            $table->text('nilai_tulis');
            $table->text('nilai_wawancara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_alternatif');
        Schema::table('tb_form_pendaftaran', function (Blueprint $table) {
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
};
