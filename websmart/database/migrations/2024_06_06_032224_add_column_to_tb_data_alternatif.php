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
            $table->string('rpl_sbd')->nullable();
            $table->string('rpl_tkti')->nullable();
            $table->string('rpl_adpl')->nullable();
            $table->string('rpl_mpti')->nullable();
            $table->string('rpl_ppla')->nullable();
            $table->string('rpl_visi')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropColumn('rpl_sbd');
            $table->dropColumn('rpl_tkti');
            $table->dropColumn('rpl_adpl');
            $table->dropColumn('rpl_mpti');
            $table->dropColumn('rpl_ppla');
            $table->dropColumn('rpl_visi');

        });
    }
};
