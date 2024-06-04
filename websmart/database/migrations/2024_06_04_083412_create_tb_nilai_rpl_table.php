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
        Schema::create('tb_nilai_rpl', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('lab')->nullable();
            $table->integer('algo1')->nullable();
            $table->integer('pbo')->nullable();
            $table->integer('sql')->nullable();
            $table->integer('pweb')->nullable();
            $table->integer('uiux')->nullable();
            $table->integer('ood')->nullable();
            $table->integer('algo2')->nullable();
            $table->integer('paa')->nullable();
            $table->integer('pmobile')->nullable();
            $table->integer('sbd')->nullable();
            $table->integer('tkti')->nullable();
            $table->integer('adpl')->nullable();
            $table->integer('mpti')->nullable();
            $table->integer('ppla')->nullable();
            $table->integer('visi')->nullable();
            $table->integer('wawasan')->nullable();
            $table->integer('komitmen')->nullable();
            $table->integer('fairness')->nullable();
            $table->integer('teamwork')->nullable();
            $table->integer('potensi')->nullable();
            $table->integer('analisis')->nullable();
            $table->integer('technical')->nullable();
            $table->integer('portofolio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nilai_rpl');
        Schema::table('tb_nilai_rpl', function (Blueprint $table) {
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
