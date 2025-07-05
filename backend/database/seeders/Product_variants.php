<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Product_variants extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variants')->insert([
            [
                'product_id' => 1,
                'color' => 'trắng',
                'size' => '36',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-chunky.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color' => 'trắng',
                'size' => '37',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-chunky.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color' => 'trắng',
                'size' => '38',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-chunky.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color' => 'trắng',
                'size' => '39',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-chunky.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color' => 'trắng',
                'size' => '40',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-chunky.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color' => 'trắng-hồng',
                'size' => '36',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-ulzzang-hanquoc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color' => 'trắng-hồng',
                'size' => '37',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-ulzzang-hanquoc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color' => 'trắng-hồng',
                'size' => '38',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-ulzzang-hanquoc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color' => 'trắng-hồng',
                'size' => '39',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-ulzzang-hanquoc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color' => 'trắng-hồng',
                'size' => '40',
                'stock_quantity' => 10,
                'image_color_var' => 'sneaker-nu-ulzzang-hanquoc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sản phẩm 3
    ['product_id' => 3, 'color' => 'trắng-xanh', 'size' => '36', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-pastel.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 3, 'color' => 'trắng-xanh', 'size' => '37', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-pastel.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 3, 'color' => 'trắng-xanh', 'size' => '38', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-pastel.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 3, 'color' => 'trắng-xanh', 'size' => '39', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-pastel.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 3, 'color' => 'trắng-xanh', 'size' => '40', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-pastel.jpg', 'created_at' => now(), 'updated_at' => now()],

    // Sản phẩm 4
    ['product_id' => 4, 'color' => 'trắng', 'size' => '36', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-trang.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 4, 'color' => 'trắng', 'size' => '37', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-trang.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 4, 'color' => 'trắng', 'size' => '38', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-trang.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 4, 'color' => 'trắng', 'size' => '39', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-trang.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 4, 'color' => 'trắng', 'size' => '40', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-trang.jpg', 'created_at' => now(), 'updated_at' => now()],

    // Sản phẩm 5
    ['product_id' => 5, 'color' => 'xám-hồng', 'size' => '36', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-nangdong.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 5, 'color' => 'xám-hồng', 'size' => '37', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-nangdong.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 5, 'color' => 'xám-hồng', 'size' => '38', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-nangdong.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 5, 'color' => 'xám-hồng', 'size' => '39', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-nangdong.jpg', 'created_at' => now(), 'updated_at' => now()],
    ['product_id' => 5, 'color' => 'xám-hồng', 'size' => '40', 'stock_quantity' => 10, 'image_color_var' => 'sneaker-nangdong.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
