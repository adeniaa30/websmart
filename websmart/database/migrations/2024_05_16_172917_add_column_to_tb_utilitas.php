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
            $table->integer('uti_komunikasi_kerja');
            $table->integer('uti_kontribusi_ide');
            $table->string('lab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_utilitas', function (Blueprint $table) {
            $table->dropColumn('nilai_komunikasi_kerja');
            $table->dropColumn('nilai_kontribusi_ide');
            $table->dropColumn('lab');
        });
    }
};
