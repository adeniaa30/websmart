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
        Schema::create('tb_data_lab_ai', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('prodi');
            $table->float('ipk');
            $table->string('lab');
            $table->string('sertif_prestasi')->nullable();
            $table->string('sertif_organisasi')->nullable();
            $table->string('nilai_matkulx');
            $table->string('nilai_matkuly');
            $table->string('nilai_matkulz');
            $table->string('ide_project');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_lab_ai');
        Schema::table('tb_form_pendaftaran', function (Blueprint $table) {
            $table->dropColumn('nim');
            $table->dropColumn('nama');
            $table->dropColumn('prodi');
            $table->dropColumn('ipk');
            $table->dropColumn('lab');
            $table->dropColumn('sertif_prestasi');
            $table->dropColumn('sertif_organisasi');
            $table->dropColumn('nilai_matkulx');
            $table->dropColumn('nilai_matkuly');
            $table->dropColumn('nilai_matkulz');
            $table->dropColumn('ide_project');
        });
    }
};
