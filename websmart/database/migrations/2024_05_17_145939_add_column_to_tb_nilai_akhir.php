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
        Schema::table('tb_nilai_akhir', function (Blueprint $table) {
            $table->float('na_datmin')->nullable()->after('na_pkb');
            $table->dropColumn('na_komunikasi_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_nilai_akhir', function (Blueprint $table) {
            $table->dropColumn('na_datmin');
            $table->float('na_komunikasi_kerja')->nullable();
        });
    }
};
