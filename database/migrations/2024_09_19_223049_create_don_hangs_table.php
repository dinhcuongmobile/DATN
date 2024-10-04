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
            $table->foreignId('user_id')->constrained('users');
            $table->string('ho_ten_nhan');
            $table->dateTime('ngay_dat_hang');
            $table->string('dia_chi_nhan');
            $table->string('so_dien_thoai_nhan', 10);
            $table->double('tong_thanh_toan', 20, 2);
            $table->integer('phuong_thuc_thanh_toan')->default(0);
            $table->integer('trang_thai')->default(0);
            $table->integer('thanh_toan')->default(0);
            $table->timestamps();
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
