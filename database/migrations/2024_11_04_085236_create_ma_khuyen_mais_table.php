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
        Schema::create('ma_khuyen_mais', function (Blueprint $table) {
            $table->id();
            $table->string('ma_giam_gia');
            $table->double('so_tien_giam', 10, 2);
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->double('gia_tri_toi_thieu', 10, 2)->default(0);
            $table->integer('trang_thai');  // 1. Giảm giá đơn hàng, 2. giảm giá vận chuyển
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_khuyen_mais');
    }
};
