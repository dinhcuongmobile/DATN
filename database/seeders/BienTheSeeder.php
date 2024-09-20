<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BienTheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bien_thes')->insert([
            [
                'san_pham_id' => 1, // ID của sản phẩm tương ứng
                'kich_co' => 'M',
                'mau_sac' => 'Đen',
                'so_luong' => 10,
            ],
            [
                'san_pham_id' => 1,
                'kich_co' => 'L',
                'mau_sac' => 'Trắng',
                'so_luong' => 5,
            ],
            [
                'san_pham_id' => 2,
                'kich_co' => 'S',
                'mau_sac' => 'Xanh',
                'so_luong' => 15,
            ],
            [
                'san_pham_id' => 3,
                'kich_co' => 'XL',
                'mau_sac' => 'Đỏ',
                'so_luong' => 8,
            ],
            [
                'san_pham_id' => 4,
                'kich_co' => 'M',
                'mau_sac' => 'Vàng',
                'so_luong' => 20,
            ],
        ]);
    }
}
