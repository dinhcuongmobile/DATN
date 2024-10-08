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
        Schema::create('vn_tinh_thanh_phos', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_tinh_thanh_pho')->primary();
            $table->string('ten_tinh_thanh_pho');
            $table->string('type',30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vn_tinh_thanh_phos');
    }
};
