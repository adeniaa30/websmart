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
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->string('pc_link_project');
            $table->string('pc_ppla');
            $table->string('pc_sd');
            $table->string('pc_paa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropColumn('pc_link_project');
            $table->dropColumn('pc_ppla');
            $table->dropColumn('pc_sd');
            $table->dropColumn('pc_paa');
        });
    }
};
