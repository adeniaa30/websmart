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
            $table->integer('nilaipc_tanggungjawab')->nullable();
            $table->integer('nilaipc_project')->nullable();
            $table->integer('nilaipc_ppla')->nullable();
            $table->integer('nilaipc_sd')->nullable();
            $table->integer('nilaipc_paa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_nilai_alternatif', function (Blueprint $table) {
            $table->dropColumn('nilaipc_tanggungjawab');
            $table->dropColumn('nilaipc_project');
            $table->dropColumn('nilaipc_ppla');
            $table->dropColumn('nilaipc_sd');
            $table->dropColumn('nilaipc_paa');
        });
    }
};
