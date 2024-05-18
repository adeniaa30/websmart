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
        Schema::table('tb_nilai_alternatif', function (Blueprint $table) {
            $table->integer('nilai_komunikasi_kerja');
            $table->integer('nilai_kontribusi_ide');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_nilai_alternatif', function (Blueprint $table) {
            $table->dropColumn('nilai_komunikasi_kerja');
            $table->dropColumn('nilai_kontribusi_ide');
        });
    }
};
