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
            $table->string('rpl_wawasan')->nullable();
            $table->string('rpl_komitmen')->nullable();
            $table->string('rpl_fairness')->nullable();
            $table->string('rpl_teamwork')->nullable();
            $table->string('rpl_potensi')->nullable();
            $table->string('rpl_analisis')->nullable();
            $table->string('rpl_technical')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropColumn('rpl_wawasan');
            $table->dropColumn('rpl_komitmen');
            $table->dropColumn('rpl_fairness');
            $table->dropColumn('rpl_teamwork');
            $table->dropColumn('rpl_potensi');
            $table->dropColumn('rpl_analisis');
            $table->dropColumn('rpl_technical');

        });
    }
};
