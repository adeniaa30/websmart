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
        Schema::create('tb_utilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->float('uti_ipk');
            $table->float('uti_sertif_prestasi');
            $table->float('uti_sertif_organisasi');
            $table->float('uti_tulis');
            $table->float('uti_wawancara');
            $table->float('uti_matkulx');
            $table->float('uti_matkuly');
            $table->float('uti_matkulz');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_utilitas');
        Schema::table('tb_utilitas', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('uti_ipk');
            $table->dropColumn('uti_sertif_prestasi');
            $table->dropColumn('uti_sertif_organisasi');
            $table->dropColumn('uti_tulis');
            $table->dropColumn('uti_wawancara');
            $table->dropColumn('uti_matkulx');
            $table->dropColumn('uti_matkuly');
            $table->dropColumn('uti_matkulz');
        });
    }
};
