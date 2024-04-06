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
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->foreign('da_nim')
                  ->references('nim')
                  ->on('tb_alternatif')
                  ->onDelete('cascade'); // Optional: Specify the delete action
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_alternatif', function (Blueprint $table) {
            $table->dropForeign(['nim']);
        });
    }
};
