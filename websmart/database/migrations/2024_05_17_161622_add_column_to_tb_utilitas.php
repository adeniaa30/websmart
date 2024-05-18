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
        Schema::table('tb_utilitas', function (Blueprint $table) {
            $table->float('utipc_ppla')->nullable();
            $table->float('utipc_sd')->nullable();
            $table->float('utipc_paa')->nullable();
            $table->float('utipc_tanggung_jawab')->nullable();
            $table->float('utipc_project')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_utilitas', function (Blueprint $table) {
            $table->dropColumn('utipc_ppla');
            $table->dropColumn('utipc_sd');
            $table->dropColumn('utipc_paa');
            $table->dropColumn('utipc_tanggung_jawab');
            $table->dropColumn('utipc_project');
        });
    }
};
