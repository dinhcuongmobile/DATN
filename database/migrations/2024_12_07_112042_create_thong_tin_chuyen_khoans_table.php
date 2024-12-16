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
        Schema::create('thong_tin_chuyen_khoans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique(); // vnp_TxnRef
            $table->bigInteger('so_tien'); // vnp_Amount
            $table->string('mo_ta_don_hang')->nullable(); // vnp_OrderInfo
            $table->string('ma_giao_dich_vnpay')->nullable(); // vnp_TransactionNo
            $table->string('ma_ngan_hang')->nullable(); // vnp_BankCode
            $table->string('ma_giao_dich_ngan_hang')->nullable(); // vnp_BankTranNo
            $table->string('ma_phan_hoi')->nullable(); // vnp_ResponseCode
            $table->string('trang_thai_giao_dich')->nullable(); // vnp_TransactionStatus
            $table->timestamp('thoi_gian_thanh_toan')->nullable(); // vnp_PayDate
            $table->string('chu_ky_vnpay'); // vnp_SecureHash
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_tin_chuyen_khoans');
    }
};
