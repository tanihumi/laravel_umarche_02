<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => '店名が入ります',
                'infomation' => '情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります',
                'filename' => '',
                'is_selling' => true,
            ],
            [
                'owner_id' => 2,
                'name' => '店名が入ります',
                'infomation' => '情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります情報が入ります',
                'filename' => '',
                'is_selling' => true,
            ],
        ]);
    }
}
