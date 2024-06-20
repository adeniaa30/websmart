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
            $table->string('detail_porto')->nullable()->after('portofolio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_rpl', function (Blueprint $table) {
            $table->dropColumn('detail_porto');
        });
    }
};
