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
            $table->string('itnilai_sop')->nullable();
            $table->string('itnilai_jarkom')->nullable();
            $table->string('itnilai_dmj')->nullable();
            $table->string('itnilai_rns')->nullable();
            $table->string('itnilai_mengajar')->nullable();
            $table->string('itnilai_probsolv')->nullable();
            $table->string('itnilai_timemj')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
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
