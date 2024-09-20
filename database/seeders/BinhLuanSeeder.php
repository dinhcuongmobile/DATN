<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BinhLuanSeeder extends Seeder
{
    public function run()
    {
        DB::table('binh_luans')->insert([
            [
                'user_id' => 6, // Giả định người dùng có ID 1
                'san_pham_id' => 1, // Giả định sản phẩm có ID 1
                'noi_dung' => 'Bình luận về sản phẩm 1 rất tuyệt vời, chất lượng tốt.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7, // Giả định người dùng có ID 2
                'san_pham_id' => 2, // Giả định sản phẩm có ID 2
                'noi_dung' => 'Sản phẩm 2 khá ổn nhưng có một vài lỗi nhỏ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8, // Giả định người dùng có ID 3
                'san_pham_id' => 1, // Giả định sản phẩm có ID 1
                'noi_dung' => 'Sản phẩm 1 không đạt kỳ vọng, cần cải thiện.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9, // Giả định người dùng có ID 4
                'san_pham_id' => 3, // Giả định sản phẩm có ID 3
                'noi_dung' => 'Dịch vụ giao hàng tốt, sản phẩm 3 đóng gói kỹ càng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10, // Giả định người dùng có ID 5
                'san_pham_id' => 2, // Giả định sản phẩm có ID 2
                'noi_dung' => 'Sản phẩm 2 tuyệt vời, rất hài lòng với chất lượng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
