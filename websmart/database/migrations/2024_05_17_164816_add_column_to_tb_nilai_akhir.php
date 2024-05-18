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
            $table->float('napc_ppla')->nullable();
            $table->float('napc_sd')->nullable();
            $table->float('napc_paa')->nullable();
            $table->float('napc_tanggung_jawab')->nullable();
            $table->float('napc_project')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_nilai_akhir', function (Blueprint $table) {
            $table->dropColumn('napc_ppla');
            $table->dropColumn('napc_sd');
            $table->dropColumn('napc_paa');
            $table->dropColumn('napc_tanggung_jawab');
            $table->dropColumn('napc_project');
        });
    }
};
