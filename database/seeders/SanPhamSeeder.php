<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('san_phams')->insert([
            [
                'danh_muc_id' => 1, // ID của danh mục tương ứng
                'hinh_anh' => 'path/to/image1.jpg',
                'ten_san_pham' => 'Điện thoại XYZ',
                'gia_san_pham' => 15000000,
                'khuyen_mai' => 10,
                'mo_ta' => 'Mô tả chi tiết cho sản phẩm Điện thoại XYZ.',
                'luot_xem' => 100,
            ],
            [
                'danh_muc_id' => 2,
                'hinh_anh' => 'path/to/image2.jpg',
                'ten_san_pham' => 'Áo thun ABC',
                'gia_san_pham' => 300000,
                'khuyen_mai' => 5,
                'mo_ta' => 'Mô tả chi tiết cho sản phẩm Áo thun ABC.',
                'luot_xem' => 200,
            ],
            [
                'danh_muc_id' => 1,
                'hinh_anh' => 'path/to/image3.jpg',
                'ten_san_pham' => 'Laptop DEF',
                'gia_san_pham' => 25000000,
                'khuyen_mai' => 15,
                'mo_ta' => 'Mô tả chi tiết cho sản phẩm Laptop DEF.',
                'luot_xem' => 150,
            ],
            [
                'danh_muc_id' => 3,
                'hinh_anh' => 'path/to/image4.jpg',
                'ten_san_pham' => 'Bánh kẹo GHI',
                'gia_san_pham' => 50000,
                'khuyen_mai' => 0,
                'mo_ta' => 'Mô tả chi tiết cho sản phẩm Bánh kẹo GHI.',
                'luot_xem' => 50,
            ],
            [
                'danh_muc_id' => 2,
                'hinh_anh' => 'path/to/image5.jpg',
                'ten_san_pham' => 'Giày thể thao JKL',
                'gia_san_pham' => 1200000,
                'khuyen_mai' => 20,
                'mo_ta' => 'Mô tả chi tiết cho sản phẩm Giày thể thao JKL.',
                'luot_xem' => 75,
            ],
        ]);
    }
}
