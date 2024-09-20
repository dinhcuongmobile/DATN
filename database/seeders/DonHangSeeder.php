<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('don_hangs')->insert([
            [
                'user_id' => 6, // ID của người dùng tương ứng
                'ho_ten_nhan' => 'Nguyễn Văn A',
                'ngay_dat_hang' => now(),
                'dia_chi_nhan' => '123 Đường A, Hà Nội',
                'so_dien_thoai_nhan' => '0123456789',
                'tong_thanh_toan' => 30000000, // Tổng thanh toán
                'phuong_thuc_thanh_toan' => 1, // Ví dụ: 1 cho thẻ tín dụng
                'trang_thai' => 0, // Trạng thái mới
                'thanh_toan' => 0, // Chưa thanh toán
            ],
            [
                'user_id' => 7,
                'ho_ten_nhan' => 'Trần Thị B',
                'ngay_dat_hang' => now(),
                'dia_chi_nhan' => '456 Đường B, TP HCM',
                'so_dien_thoai_nhan' => '0987654321',
                'tong_thanh_toan' => 1200000,
                'phuong_thuc_thanh_toan' => 0, // Ví dụ: 0 cho tiền mặt
                'trang_thai' => 1, // Đã xử lý
                'thanh_toan' => 1, // Đã thanh toán
            ],
            [
                'user_id' => 8,
                'ho_ten_nhan' => 'Lê Văn C',
                'ngay_dat_hang' => now(),
                'dia_chi_nhan' => '789 Đường C, Đà Nẵng',
                'so_dien_thoai_nhan' => '0912345678',
                'tong_thanh_toan' => 75000000,
                'phuong_thuc_thanh_toan' => 1,
                'trang_thai' => 0,
                'thanh_toan' => 0,
            ],
            [
                'user_id' => 9,
                'ho_ten_nhan' => 'Nguyễn Văn A',
                'ngay_dat_hang' => now(),
                'dia_chi_nhan' => '111 Đường D, Hải Phòng',
                'so_dien_thoai_nhan' => '0909090909',
                'tong_thanh_toan' => 500000,
                'phuong_thuc_thanh_toan' => 0,
                'trang_thai' => 0,
                'thanh_toan' => 0,
            ],
            [
                'user_id' => 10,
                'ho_ten_nhan' => 'Trần Thị B',
                'ngay_dat_hang' => now(),
                'dia_chi_nhan' => '222 Đường E, Nha Trang',
                'so_dien_thoai_nhan' => '0812345678',
                'tong_thanh_toan' => 1500000,
                'phuong_thuc_thanh_toan' => 1,
                'trang_thai' => 1,
                'thanh_toan' => 1,
            ],
        ]);
    }
}
