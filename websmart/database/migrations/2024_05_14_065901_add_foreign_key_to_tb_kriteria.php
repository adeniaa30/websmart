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
            $table->foreign('lab')
                  ->references('nama_lab')
                  ->on('tb_lab')
                  ->onDelete('cascade'); // Optional: Specify the delete action
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_kriteria', function (Blueprint $table) {
            $table->dropForeign(['lab']);
        });
    }
};
