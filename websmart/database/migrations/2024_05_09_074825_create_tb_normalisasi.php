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
        Schema::create('tb_normalisasi', function (Blueprint $table) {
            $table->id();
            $table->string('norm_kriteria');
            $table->integer('norm_bobot');
            $table->float('normalisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_normalisasi');
        Schema::table('tb_kriteria', function (Blueprint $table) {
            $table->dropColumn('norm_kriteria');
            $table->dropColumn('norm_bobot');
            $table->dropColumn('normalisasi');
        });
    }
};
