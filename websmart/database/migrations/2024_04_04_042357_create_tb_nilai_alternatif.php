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
        Schema::create('tb_nilai_alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('nilai_ipk');
            $table->integer('nilai_sertif_prestasi');
            $table->integer('nilai_sertif_organisasi');
            $table->integer('nilai_tulis');
            $table->integer('nilai_wawancara');
            $table->integer('nilai_matkul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nilai_alternatif');
        Schema::table('tb_nilai_alternatif', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('nilai_ipk');
            $table->dropColumn('nilai_sertif_prestasi');
            $table->dropColumn('nilai_sertif_organisasi');
            $table->dropColumn('nilai_tulis');
            $table->dropColumn('nilai_wawancara');
            $table->dropColumn('nilai_matkul');
        });
    }
};
