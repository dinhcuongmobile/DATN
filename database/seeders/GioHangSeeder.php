<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GioHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gio_hangs')->insert([
            [
                'user_id' => 6, // ID của người dùng tương ứng
                'san_pham_id' => 1, // ID của sản phẩm tương ứng
                'so_luong' => 2,
                'thanh_tien' => 30000000, // Giả sử giá sản phẩm là 15000000
            ],
            [
                'user_id' => 7,
                'san_pham_id' => 2,
                'so_luong' => 1,
                'thanh_tien' => 300000, // Giả sử giá sản phẩm là 300000
            ],
            [
                'user_id' => 8,
                'san_pham_id' => 3,
                'so_luong' => 3,
                'thanh_tien' => 75000000, // Giả sử giá sản phẩm là 25000000
            ],
            [
                'user_id' => 9,
                'san_pham_id' => 4,
                'so_luong' => 1,
                'thanh_tien' => 50000, // Giả sử giá sản phẩm là 50000
            ],
            [
                'user_id' => 10,
                'san_pham_id' => 5,
                'so_luong' => 2,
                'thanh_tien' => 2400000, // Giả sử giá sản phẩm là 1200000
            ],
        ]);
    }
}
