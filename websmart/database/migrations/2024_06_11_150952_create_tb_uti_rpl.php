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
        Schema::create('tb_uti_rpl', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('lab')->nullable();
            $table->float('algo1')->nullable();
            $table->float('pbo')->nullable();
            $table->float('sql')->nullable();
            $table->float('pweb')->nullable();
            $table->float('uiux')->nullable();
            $table->float('ood')->nullable();
            $table->float('algo2')->nullable();
            $table->float('paa')->nullable();
            $table->float('pmobile')->nullable();
            $table->float('sbd')->nullable();
            $table->float('tkti')->nullable();
            $table->float('adpl')->nullable();
            $table->float('mpti')->nullable();
            $table->float('ppla')->nullable();
            $table->float('visi')->nullable();
            $table->float('wawasan')->nullable();
            $table->float('komitmen')->nullable();
            $table->float('fairness')->nullable();
            $table->float('teamwork')->nullable();
            $table->float('potensi')->nullable();
            $table->float('analisis')->nullable();
            $table->float('technical')->nullable();
            $table->float('portofolio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_uti_rpl');
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
