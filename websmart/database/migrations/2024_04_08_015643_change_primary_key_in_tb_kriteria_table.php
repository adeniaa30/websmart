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
        Schema::table('tb_kriteria', function (Blueprint $table) {
            $table->dropPrimary();
            $table->bigInteger('id')->change();
            $table->primary('kriteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_kriteria', function (Blueprint $table) {
            $table->string('kriteria')->change();
            $table->primary('id');
        });
    }
};
