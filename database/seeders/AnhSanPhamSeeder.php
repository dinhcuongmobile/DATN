<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnhSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anh_san_phams')->insert([
            [
                'san_pham_id' => 1, // ID của sản phẩm tương ứng
                'hinh_anh' => 'path/to/image1.jpg',
            ],
            [
                'san_pham_id' => 1,
                'hinh_anh' => 'path/to/image1_2.jpg',
            ],
            [
                'san_pham_id' => 2,
                'hinh_anh' => 'path/to/image2.jpg',
            ],
            [
                'san_pham_id' => 3,
                'hinh_anh' => 'path/to/image3.jpg',
            ],
            [
                'san_pham_id' => 4,
                'hinh_anh' => 'path/to/image4.jpg',
            ],
        ]);
    }
}
