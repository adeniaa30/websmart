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
        Schema::create('tb_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('kriteria');
            $table->integer('bobot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kriteria');
        Schema::table('tb_kriteria', function (Blueprint $table) {
            $table->dropColumn('kriteria');
            $table->dropColumn('bobot');
        });
    }
};
