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
        Schema::table('tb_datarpl', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('lab')->nullable();
            // $table->string('algo1')->nullable();
            // $table->string('pbo')->nullable();
            // $table->string('sql')->nullable();
            // $table->string('pweb')->nullable();
            // $table->string('uiux')->nullable();
            // $table->string('ood')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_datarpl', function (Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('nim');
            $table->dropColumn('lab');
            // $table->dropColumn('algo1');
            // $table->dropColumn('pbo');
            // $table->dropColumn('sql');
            // $table->dropColumn('pweb');
            // $table->dropColumn('uiux');
            // $table->dropColumn('ood');
        });
    }
};
