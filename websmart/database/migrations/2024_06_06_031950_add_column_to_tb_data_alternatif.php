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
            $table->string('rpl_uiux')->nullable();
            $table->string('rpl_ood')->nullable();
            $table->string('rpl_algo2')->nullable();
            $table->string('rpl_paa')->nullable();
            $table->string('rpl_pmobile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropColumn('rpl_uiux');
            $table->dropColumn('rpl_ood');
            $table->dropColumn('rpl_algo2');
            $table->dropColumn('rpl_paa');
            $table->dropColumn('rpl_pmobile');
        });
    }
};
