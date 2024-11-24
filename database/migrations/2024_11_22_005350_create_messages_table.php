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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Người gửi
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onDelete('cascade'); // Người nhận (admin)
            $table->text('message'); // Nội dung tin nhắn
            $table->boolean('is_admin')->default(false); // Xác định admin hay user gửi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
