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
        Schema::create('vn_phuong_xas', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_phuong_xa')->primary();
            $table->string('ten_phuong_xa');
            $table->string('type',30);
            $table->unsignedBigInteger('ma_quan_huyen');
            $table->foreign('ma_quan_huyen')->references('ma_quan_huyen')->on('vn_quan_huyens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vn_phuong_xas');
    }
};
