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
        Schema::create('anh_danh_gias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_gia_id')->constrained('danh_gias')->onDelete('cascade');
            $table->string('hinh_anh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anh_danh_gias');
    }
};
