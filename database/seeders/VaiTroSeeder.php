<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaiTroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vai_tros')->insert([
            [
                'id' => 1,
                'vai_tro' => 'Quản trị viên'
            ],
            [
                'id' => 2,
                'vai_tro' => 'Nhân viên'
            ],
            [
                'id' => 3,
                'vai_tro' => 'Người dùng'
            ],
        ]);
    }
}
