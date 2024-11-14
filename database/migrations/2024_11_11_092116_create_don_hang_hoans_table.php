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
        Schema::create('don_hang_hoans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('don_hang_id')->constrained('don_hangs')->onDelete('cascade');
            $table->text('ly_do');
            $table->integer('trang_thai')->default(0)->comment('0.Chưa xử lý, 1.Đang xử lý, 2.Đã xử lý	');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hang_hoans');
    }
};
