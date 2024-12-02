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
        Schema::create('tin_tucs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_muc_id')->constrained('danh_muc_tin_tucs')->onDelete('cascade');
            $table->foreignId('nguoi_dang')->constrained('users')->onDelete('cascade');
            $table->string('hinh_anh')->nullable();
            $table->string('tieu_de');
            $table->longText('noi_dung');
            $table->integer('luot_xem')->default(0);
            $table->dateTime('ngay_dang')->nullable();
            $table->dateTime('ngay_cap_nhat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_tucs');
    }
};
