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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_muc_id')->constrained('danh_mucs')->onDelete('cascade');
            $table->string('hinh_anh');
            $table->string('ten_san_pham');
            $table->double('gia_san_pham', 10, 2);
            $table->integer('khuyen_mai')->default(0);
            $table->longText('mo_ta');
            $table->integer('luot_xem')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
