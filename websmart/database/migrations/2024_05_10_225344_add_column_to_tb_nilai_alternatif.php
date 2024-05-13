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
            $table->integer('nilai_matkuly')->nullable();
            $table->integer('nilai_matkulz')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_nilai_alternatif', function (Blueprint $table) {
            $table->dropColumn('nilai_matkuly');
            $table->dropColumn('nilai_matkulz');
        });
    }
};
