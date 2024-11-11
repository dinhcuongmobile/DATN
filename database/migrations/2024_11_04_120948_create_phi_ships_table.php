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
        Schema::create('phi_ships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_tinh_thanh_pho');
            $table->foreign('ma_tinh_thanh_pho')->references('ma_tinh_thanh_pho')->on('vn_tinh_thanh_phos');
            $table->unsignedBigInteger('ma_quan_huyen');
            $table->foreign('ma_quan_huyen')->references('ma_quan_huyen')->on('vn_quan_huyens');
            $table->double('phi_ship', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phi_ships');
    }
};
