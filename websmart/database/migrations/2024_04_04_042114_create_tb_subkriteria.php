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
        Schema::create('tb_subkriteria', function (Blueprint $table) {
            $table->id();
            $table->string('kriteria');
            $table->string('subkriteria');
            $table->integer('nilai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_subkriteria');
        Schema::table('tb_subkriteria', function (Blueprint $table) {
            $table->dropColumn('kriteria');
            $table->dropColumn('subkriteria');
            $table->dropColumn('nilai');
        });
    }
};
