<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LienHeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lien_hes')->insert([
            [
                'ho_va_ten' => 'Nguyen Van A',
                'email' => 'nguyenvana@example.com',
                'so_dien_thoai' => '0901234567',
                'noi_dung' => 'Xin chào, tôi muốn liên hệ về sản phẩm.',
                'trang_thai' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Tran Thi B',
                'email' => 'tranthib@example.com',
                'so_dien_thoai' => '0912345678',
                'noi_dung' => 'Tôi cần tư vấn thêm về dịch vụ.',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Le Van C',
                'email' => 'levanc@example.com',
                'so_dien_thoai' => '0923456789',
                'noi_dung' => 'Xin hãy liên hệ lại với tôi.',
                'trang_thai' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Hoang Thi D',
                'email' => 'hoangthid@example.com',
                'so_dien_thoai' => '0934567890',
                'noi_dung' => 'Cảm ơn về sản phẩm, tôi rất hài lòng.',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Pham Van E',
                'email' => 'phamvane@example.com',
                'so_dien_thoai' => '0945678901',
                'noi_dung' => 'Tôi gặp vấn đề với sản phẩm, vui lòng giúp đỡ.',
                'trang_thai' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
