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
        Schema::create('tb_data_rpl', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('lab')->nullable();
            $table->string('algo1')->nullable();
            $table->string('pbo')->nullable();
            $table->string('sql')->nullable();
            $table->string('pweb')->nullable();
            $table->string('uiux')->nullable();
            $table->string('ood')->nullable();
            $table->string('algo2')->nullable();
            $table->string('paa')->nullable();
            $table->string('pmobile')->nullable();
            $table->string('sbd')->nullable();
            $table->string('tkti')->nullable();
            $table->string('adpl')->nullable();
            $table->string('mpti')->nullable();
            $table->string('ppla')->nullable();
            $table->string('visi')->nullable();
            $table->string('wawasan')->nullable();
            $table->string('komitmen')->nullable();
            $table->string('fairness')->nullable();
            $table->string('teamwork')->nullable();
            $table->string('potensi')->nullable();
            $table->string('analisis')->nullable();
            $table->string('technical')->nullable();
            $table->string('portofolio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_rpl');
        Schema::table('tb_data_rpl', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('nim');
            $table->dropColumn('lab');
            $table->dropColumn('algo1');
            $table->dropColumn('pbo');
            $table->dropColumn('sql');
            $table->dropColumn('pweb');
            $table->dropColumn('uiux');
            $table->dropColumn('ood');
            $table->dropColumn('algo2');
            $table->dropColumn('paa');
            $table->dropColumn('pmobile');
            $table->dropColumn('sbd');
            $table->dropColumn('tkti');
            $table->dropColumn('adpl');
            $table->dropColumn('mpti');
            $table->dropColumn('ppla');
            $table->dropColumn('visi');
            $table->dropColumn('wawasan');
            $table->dropColumn('komitmen');
            $table->dropColumn('fairness');
            $table->dropColumn('teamwork');
            $table->dropColumn('potensi');
            $table->dropColumn('analisis');
            $table->dropColumn('technical');
            $table->dropColumn('portofolio');
        });
    }
};
