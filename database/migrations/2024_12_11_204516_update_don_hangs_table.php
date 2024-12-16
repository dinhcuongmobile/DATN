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
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->unsignedBigInteger('nguoi_ban')->nullable()->after('user_id');
            $table->foreign('nguoi_ban')->references('id')->on('users')->onDelete('cascade');
            $table->date('ngay_ban')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('nguoi_ban');
    }
};
