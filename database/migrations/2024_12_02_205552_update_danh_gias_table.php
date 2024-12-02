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
        Schema::table('danh_gias', function (Blueprint $table) {
            $table->integer('trang_thai')->default(0)->comment('0 chưa phản hồi, 1 đã phản hồi, 2 bị ẩn')->after('so_sao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('danh_gias', function (Blueprint $table) {
            //
        });
    }
};
