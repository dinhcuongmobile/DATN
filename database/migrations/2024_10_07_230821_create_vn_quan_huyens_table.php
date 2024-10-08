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
        Schema::create('vn_quan_huyens', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_quan_huyen')->primary();
            $table->string('ten_quan_huyen');
            $table->string('type',30);
            $table->unsignedBigInteger('ma_tinh_thanh_pho');
            $table->foreign('ma_tinh_thanh_pho')->references('ma_tinh_thanh_pho')->on('vn_tinh_thanh_phos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vn_quan_huyens');
    }
};
