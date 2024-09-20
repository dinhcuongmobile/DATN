<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TinTucSeeder extends Seeder
{
    public function run()
    {
        DB::table('tin_tucs')->insert([
            [
                'hinh_anh' => 'image1.jpg',
                'tieu_de' => 'Tin tức 1',
                'noi_dung' => 'Nội dung tin tức 1 là một bài viết về chủ đề thời sự.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hinh_anh' => 'image2.jpg',
                'tieu_de' => 'Tin tức 2',
                'noi_dung' => 'Nội dung tin tức 2 là một bài viết về chủ đề kinh tế.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hinh_anh' => 'image3.jpg',
                'tieu_de' => 'Tin tức 3',
                'noi_dung' => 'Nội dung tin tức 3 là một bài viết về chủ đề xã hội.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hinh_anh' => 'image4.jpg',
                'tieu_de' => 'Tin tức 4',
                'noi_dung' => 'Nội dung tin tức 4 là một bài viết về chủ đề thể thao.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hinh_anh' => 'image5.jpg',
                'tieu_de' => 'Tin tức 5',
                'noi_dung' => 'Nội dung tin tức 5 là một bài viết về chủ đề công nghệ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
