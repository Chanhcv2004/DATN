<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Sneaker nữ',
                'description' => 'Giày sneaker dành cho nữ',
                'status' => 'Hiện thị',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Giày cao gót',
                'description' => 'Tôn dáng và nữ tính',
                'status' => 'Hiện thị',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Sandal nữ',
                'description' => 'Thoáng mát, dễ chịu cho mùa hè',
                'status' => 'Hiện thị',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Giày thể thao nữ',
                'description' => 'Phù hợp vận động, tập gym',
                'status' => 'Hiện thị',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
