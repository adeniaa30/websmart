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
        Schema::table('tb_nilai_akhir', function (Blueprint $table) {
            $table->integer('na_komunikasi_kerja');
            $table->integer('na_kontribusi_ide');
            $table->string('lab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_nilai_akhir', function (Blueprint $table) {
            $table->dropColumn('na_komunikasi_kerja');
            $table->dropColumn('na_kontribusi_ide');
            $table->dropColumn('lab');
        });
    }
};
