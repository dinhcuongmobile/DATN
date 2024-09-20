<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'ho_va_ten' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'email_verified_at' => now(),
                'email_verification_token' => Str::random(10),
                'password' => Hash::make('password123'), // mật khẩu được mã hóa
                'so_dien_thoai' => '0123456789',
                'dia_chi' => '123 Đường A, Hà Nội',
                'vai_tro_id' => 1, // Vai trò ID phải tồn tại trong bảng `vai_tros`
                'remember_token' => Str::random(10),
                'password_reset_token' => null,
                'trang_thai' => 1, // trạng thái hoạt động
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'email_verified_at' => now(),
                'email_verification_token' => Str::random(10),
                'password' => Hash::make('password123'),
                'so_dien_thoai' => '0987654321',
                'dia_chi' => '456 Đường B, TP HCM',
                'vai_tro_id' => 2,
                'remember_token' => Str::random(10),
                'password_reset_token' => null,
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Lê Văn C',
                'email' => 'levanc@example.com',
                'email_verified_at' => null,
                'email_verification_token' => null,
                'password' => Hash::make('password123'),
                'so_dien_thoai' => '0912345678',
                'dia_chi' => '789 Đường C, Đà Nẵng',
                'vai_tro_id' => 3,
                'remember_token' => Str::random(10),
                'password_reset_token' => null,
                'trang_thai' => 0, // tài khoản chưa hoạt động
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Phạm Thị D',
                'email' => 'phamthid@example.com',
                'email_verified_at' => now(),
                'email_verification_token' => Str::random(10),
                'password' => Hash::make('password123'),
                'so_dien_thoai' => '0909090909',
                'dia_chi' => '111 Đường D, Hải Phòng',
                'vai_tro_id' => 2,
                'remember_token' => Str::random(10),
                'password_reset_token' => null,
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_va_ten' => 'Hoàng Văn E',
                'email' => 'hoangvane@example.com',
                'email_verified_at' => null,
                'email_verification_token' => null,
                'password' => Hash::make('password123'),
                'so_dien_thoai' => '0812345678',
                'dia_chi' => '222 Đường E, Nha Trang',
                'vai_tro_id' => 3,
                'remember_token' => Str::random(10),
                'password_reset_token' => null,
                'trang_thai' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
