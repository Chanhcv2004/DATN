<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Sneaker Nữ Chunky Đế Cao',
                'description' => 'Kiểu dáng thời trang, đế cao giúp tăng chiều cao, dễ phối đồ với nhiều trang phục.',
                'price_original' => 450000,
                'sale_price' => 389000,
                'status' => 'Còn hàng',
                'category_id' => 1,
                'brand_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Sneaker Nữ Ulzzang Hàn Quốc',
                'description' => 'Thiết kế trẻ trung phong cách Ulzzang, phù hợp đi học, đi chơi và dạo phố.',
                'price_original' => 420000,
                'sale_price' => 365000,
                'status' => 'Còn hàng',
                'category_id' => 1,
                'brand_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
