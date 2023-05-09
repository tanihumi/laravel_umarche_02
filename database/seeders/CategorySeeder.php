<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('primary_categories')->insert([
            [
                'name' => 'キッズファッション',
                'sort_order' => 1,
            ],
            [
                'name' => 'ギフト',
                'sort_order' => 2,
            ],
            [
                'name' => 'ベビーカー',
                'sort_order' => 3,
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => '靴',
                'sort_order' => 1,
                'primary_category_id' => 1
            ],
            [
                'name' => 'トップス',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],
            [
                'name' => 'バッグ',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],
            [
                'name' => 'ギフトセット',
                'sort_order' => 4,
                'primary_category_id' => 2
            ],
            [
                'name' => 'メモリアルセット',
                'sort_order' => 5,
                'primary_category_id' => 2
            ],
            [
                'name' => 'ケーキセット',
                'sort_order' => 6,
                'primary_category_id' => 2
            ],
        ]);
    }
}
