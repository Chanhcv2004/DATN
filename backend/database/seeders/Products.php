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
            [
                'product_name' => 'Giày Thể Thao Nữ Phối Màu Pastel',
                'description' => 'Màu pastel nhẹ nhàng, kiểu dáng basic phù hợp với mọi phong cách.',
                'price_original' => 400000,
                'sale_price' => 349000,
                'status' => 'Còn hàng',
                'category_id' => 1,
                'brand_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Sneaker Nữ Đế Bằng Màu Trắng',
                'description' => 'Giày đế bằng cổ điển, dễ phối đồ, phù hợp mọi dịp đi học, đi chơi.',
                'price_original' => 390000,
                'sale_price' => 329000,
                'status' => 'Còn hàng',
                'category_id' => 1,
                'brand_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Sneaker Nữ Thể Thao Năng Động',
                'description' => 'Thiết kế thể thao giúp nâng đỡ bàn chân, phù hợp tập gym và vận động.',
                'price_original' => 480000,
                'sale_price' => 399000,
                'status' => 'Còn hàng',
                'category_id' => 1,
                'brand_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
