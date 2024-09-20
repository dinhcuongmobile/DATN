<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaKhuyenMaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ma_khuyen_mais')->insert([
            [
                'san_pham_id' => 1, // ID của sản phẩm tương ứng
                'ma_giam_gia' => 'KM2024A',
                'so_tien_giam' => 500000,
                'ngay_bat_dau' => '2024-09-01',
                'ngay_ket_thuc' => '2024-09-30',
                'gia_tri_toi_thieu' => 2000000,
            ],
            [
                'san_pham_id' => 2,
                'ma_giam_gia' => 'KM2024B',
                'so_tien_giam' => 200000,
                'ngay_bat_dau' => '2024-09-10',
                'ngay_ket_thuc' => '2024-09-20',
                'gia_tri_toi_thieu' => 1000000,
            ],
            [
                'san_pham_id' => 3,
                'ma_giam_gia' => 'KM2024C',
                'so_tien_giam' => 1000000,
                'ngay_bat_dau' => '2024-09-15',
                'ngay_ket_thuc' => '2024-09-25',
                'gia_tri_toi_thieu' => 3000000,
            ],
            [
                'san_pham_id' => 4,
                'ma_giam_gia' => 'KM2024D',
                'so_tien_giam' => 150000,
                'ngay_bat_dau' => '2024-09-05',
                'ngay_ket_thuc' => '2024-09-15',
                'gia_tri_toi_thieu' => 500000,
            ],
            [
                'san_pham_id' => 5,
                'ma_giam_gia' => 'KM2024E',
                'so_tien_giam' => 250000,
                'ngay_bat_dau' => '2024-09-20',
                'ngay_ket_thuc' => '2024-09-30',
                'gia_tri_toi_thieu' => 1500000,
            ],
        ]);
    }
}
