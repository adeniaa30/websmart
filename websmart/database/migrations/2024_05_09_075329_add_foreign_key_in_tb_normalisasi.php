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
        Schema::table('tb_normalisasi', function (Blueprint $table) {
            $table->foreign('norm_kriteria')
                  ->references('kriteria')
                  ->on('tb_kriteria')
                  ->onDelete('cascade'); // Optional: Specify the delete action
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_normalisasi', function (Blueprint $table) {
            $table->dropForeign(['norm_kriteria']);
        });
    }
};
