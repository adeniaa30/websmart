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
        Schema::create('tb_nilai_akhir', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->float('na_ipk');
            $table->float('na_sertif_prestasi');
            $table->float('na_sertif_organisasi');
            $table->float('na_tulis');
            $table->float('na_wawancara');
            $table->float('na_matkulx');
            $table->float('na_matkuly');
            $table->float('na_matkulz');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nilai_akhir');
        Schema::table('tb_nilai_akhir', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('na_ipk');
            $table->dropColumn('na_sertif_prestasi');
            $table->dropColumn('na_sertif_organisasi');
            $table->dropColumn('na_tulis');
            $table->dropColumn('na_wawancara');
            $table->dropColumn('na_matkulx');
            $table->dropColumn('na_matkuly');
            $table->dropColumn('na_matkulz');
        });
    }
};
