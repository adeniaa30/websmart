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
        Schema::table('tb_data_rpl', function (Blueprint $table) {
            $table->string('khs')->nullable();
            $table->string('div1')->nullable();
            $table->string('div2')->nullable();
            $table->string('pertanyaan_divisi')->nullable();
            $table->string('mbkm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_rpl', function (Blueprint $table) {
            //
        });
    }
};
