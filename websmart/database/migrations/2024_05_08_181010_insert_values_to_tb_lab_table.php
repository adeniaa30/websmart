<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('tb_lab')->insert([
            ['nama_lab' => 'Laboratorium Pertanian Cerdas'],
            ['nama_lab' => 'Laboratorium Infrastruktur Teknologi'],
            ['nama_lab' => 'Laboratorium Rekayasa Perangkat Lunak'],
            ['nama_lab' => 'Laboratorium Artificial Intelligence'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('tb_lab')->truncate();
    }
};
