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
            ['vai_tro' => 'Admin'],
            ['vai_tro' => 'User'],
            ['vai_tro' => 'Manager'],
            ['vai_tro' => 'Editor'],
            ['vai_tro' => 'Viewer'],
        ]);
    }
}
