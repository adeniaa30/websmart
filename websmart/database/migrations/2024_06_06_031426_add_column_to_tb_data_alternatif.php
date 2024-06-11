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
            $table->string('rpl_algo1')->nullable();
            $table->string('rpl_pbo')->nullable();
            $table->string('rpl_sql')->nullable();
            $table->string('rpl_pweb')->nullable();
            // $table->string('rpl_uiux')->nullable();
            // $table->string('rpl_ood')->nullable();
            // $table->string('rpl_algo2')->nullable();
            // $table->string('rpl_paa')->nullable();
            // $table->string('rpl_pmobile')->nullable();
            // $table->string('rpl_sbd')->nullable();
            // $table->string('rpl_tkti')->nullable();
            // $table->string('rpl_adpl')->nullable();
            // $table->string('rpl_mpti')->nullable();
            // $table->string('rpl_ppla')->nullable();
            // $table->string('rpl_visi')->nullable();
            // $table->string('rpl_wawasan')->nullable();
            // $table->string('rpl_komitmen')->nullable();
            // $table->string('rpl_fairness')->nullable();
            // $table->string('rpl_teamwork')->nullable();
            // $table->string('rpl_potensi')->nullable();
            // $table->string('rpl_analisis')->nullable();
            // $table->string('rpl_technical')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropColumn('rpl_algo1');
            $table->dropColumn('rpl_pbo');
            $table->dropColumn('rpl_sql');
            $table->dropColumn('rpl_pweb');
            // $table->dropColumn('rpl_uiux');
            // $table->dropColumn('rpl_ood');
            // $table->dropColumn('rpl_algo2');
            // $table->dropColumn('rpl_paa');
            // $table->dropColumn('rpl_pmobile');
            // $table->dropColumn('rpl_sbd');
            // $table->dropColumn('rpl_tkti');
            // $table->dropColumn('rpl_adpl');
            // $table->dropColumn('rpl_mpti');
            // $table->dropColumn('rpl_ppla');
            // $table->dropColumn('rpl_visi');
            // $table->dropColumn('rpl_wawasan');
            // $table->dropColumn('rpl_komitmen');
            // $table->dropColumn('rpl_fairness');
            // $table->dropColumn('rpl_teamwork');
            // $table->dropColumn('rpl_potensi');
            // $table->dropColumn('rpl_analisis');
            // $table->dropColumn('rpl_technical');
        });
    }
};
