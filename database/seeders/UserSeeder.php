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
                'id' => 1,
                'ho_va_ten' => 'Admin',
                'email' => 'namastore@gmail.com',
                'email_verified_at' => null,
                'email_verification_token' => null,
                'password' => Hash::make('Namastore2024'), // mật khẩu được mã hóa
                'so_dien_thoai' => '0999999999',
                'dia_chi' => null,
                'vai_tro_id' => 1, // Vai trò ID phải tồn tại trong bảng `vai_tros`
                'remember_token' => null,
                'password_reset_token' => null,
                'trang_thai' => 0, // trạng thái hoạt động
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
