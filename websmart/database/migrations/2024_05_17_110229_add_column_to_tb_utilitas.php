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
            $table->integer('uti_datmin')->nullable()->after('uti_matkulz');
            $table->dropColumn('uti_komunikasi_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_utilitas', function (Blueprint $table) {
            //
        });
    }
};
