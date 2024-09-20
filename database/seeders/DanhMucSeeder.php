<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danh_mucs')->insert([
            ['hinh_anh' => 'path/to/image1.jpg', 'ten_danh_muc' => 'Điện tử'],
            ['hinh_anh' => 'path/to/image2.jpg', 'ten_danh_muc' => 'Thời trang'],
            ['hinh_anh' => 'path/to/image3.jpg', 'ten_danh_muc' => 'Thực phẩm'],
            ['hinh_anh' => 'path/to/image4.jpg', 'ten_danh_muc' => 'Nội thất'],
            ['hinh_anh' => 'path/to/image5.jpg', 'ten_danh_muc' => 'Sắc đẹp'],
        ]);
    }
}
