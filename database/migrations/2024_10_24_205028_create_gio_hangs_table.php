<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gio_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('san_pham_id')->constrained('san_phams')->onDelete('cascade');
            $table->foreignId('bien_the_id')->constrained('bien_thes')->onDelete('cascade');
            $table->integer('so_luong');
            $table->double('thanh_tien', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gio_hangs');
    }
};
