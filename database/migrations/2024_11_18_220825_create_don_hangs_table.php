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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang',255);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('nguoi_ban')->nullable();
            $table->foreign('nguoi_ban')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('dia_chi_id')->constrained('dia_chis')->onDelete('cascade');
            $table->double('giam_gia_van_chuyen', 10, 2)->default(0);
            $table->double('giam_gia_don_hang', 10, 2)->default(0);
            $table->integer('namad_xu')->default(0);
            $table->double('tong_thanh_toan', 20, 2);
            $table->integer('phuong_thuc_thanh_toan')->default(0)->comment('0. ship cod, 1. Chuyển khoản');
            $table->integer('trang_thai')->default(0)->comment('0. chưa duyệt 1.Đang chuẩn bị hàng 2. Đang giao 3. Đã giao 4. Đã hủy');
            $table->integer('thanh_toan')->default(0)->comment('0. Chưa thanh toán, 1. Đã thanh toán');
            $table->text('ghi_chu')->nullable();
            $table->datetime('ngay_tao')->nullable();
            $table->datetime('ngay_cap_nhat')->nullable();
            $table->date('ngay_ban')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
