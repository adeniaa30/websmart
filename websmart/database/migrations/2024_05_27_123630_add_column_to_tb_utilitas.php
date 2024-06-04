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
            $table->integer('itnilai_sop')->nullable();
            $table->integer('itnilai_jarkom')->nullable();
            $table->integer('itnilai_dmj')->nullable();
            $table->integer('itnilai_rns')->nullable();
            $table->integer('itnilai_mengajar')->nullable();
            $table->integer('itnilai_probsolv')->nullable();
            $table->integer('itnilai_timemj')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_utilitas', function (Blueprint $table) {
            $table->dropColumn('itnilai_sop');
            $table->dropColumn('itnilai_jarkom');
            $table->dropColumn('itnilai_dmj');
            $table->dropColumn('itnilai_rns');
            $table->dropColumn('itnilai_mengajar');
            $table->dropColumn('itnilai_probsolv');
            $table->dropColumn('itnilai_timemj');
        });
    }
};
