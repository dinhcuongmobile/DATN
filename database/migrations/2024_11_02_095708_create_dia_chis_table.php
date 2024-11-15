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
        Schema::create('dia_chis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('ho_va_ten_nhan');
            $table->string('so_dien_thoai_nhan', 10);
            $table->unsignedBigInteger('ma_tinh_thanh_pho');
            $table->foreign('ma_tinh_thanh_pho')->references('ma_tinh_thanh_pho')->on('vn_tinh_thanh_phos');
            $table->unsignedBigInteger('ma_quan_huyen');
            $table->foreign('ma_quan_huyen')->references('ma_quan_huyen')->on('vn_quan_huyens');
            $table->unsignedBigInteger('ma_phuong_xa');
            $table->foreign('ma_phuong_xa')->references('ma_phuong_xa')->on('vn_phuong_xas');
            $table->string('dia_chi_chi_tiet')->nullable();
            $table->integer('trang_thai')->default(2);  // 1: mặc định , 2: bình thường
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_chis');
    }
};
