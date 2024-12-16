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
        Schema::create('thong_baos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Người nhận thông báo
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('hinh_anh')->nullable();
            $table->string('tieu_de'); // Tiêu đề thông báo
            $table->text('noi_dung'); // Nội dung thông báo
            $table->boolean('trang_thai')->default(false)->comment("0. chưa đọc 1. Đã đọc"); // Trạng thái đọc
            $table->boolean('nguoi_nhan')->default(false)->comment("0. thành viên 1. admin"); // Trạng thái đọc
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_baos');
    }
};
