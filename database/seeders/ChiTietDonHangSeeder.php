<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietDonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chi_tiet_don_hangs')->insert([
            [
                'don_hang_id' => 1, // ID của đơn hàng tương ứng
                'san_pham_id' => 1, // ID của sản phẩm tương ứng
                'so_luong' => 2,
                'don_gia' => 15000000, // Giá sản phẩm
                'thanh_tien' => 30000000, // Tổng tiền
            ],
            [
                'don_hang_id' => 1,
                'san_pham_id' => 2,
                'so_luong' => 1,
                'don_gia' => 300000,
                'thanh_tien' => 300000,
            ],
            [
                'don_hang_id' => 2,
                'san_pham_id' => 3,
                'so_luong' => 3,
                'don_gia' => 25000000, // Giá sản phẩm
                'thanh_tien' => 75000000,
            ],
            [
                'don_hang_id' => 2,
                'san_pham_id' => 4,
                'so_luong' => 1,
                'don_gia' => 50000,
                'thanh_tien' => 50000,
            ],
            [
                'don_hang_id' => 3,
                'san_pham_id' => 5,
                'so_luong' => 2,
                'don_gia' => 1200000,
                'thanh_tien' => 2400000,
            ],
        ]);
    }
}
