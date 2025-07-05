<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Images extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $images = [
            // Sản phẩm 1: Nike Air Zoom Pegasus 41
            [
                'url' => 'sneaker-nu-ulzzang-hanquoc.jpg',
                'image_able_id' => 1,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sneaker-nu-ulzzang-hanquoc-1.jpg',
                'image_able_id' => 1,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sneaker-nu-ulzzang-hanquoc-2.jpg',
                'image_able_id' => 1,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sneaker-nu-ulzzang-hanquoc-3.jpg',
                'image_able_id' => 1,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Sản phẩm 2: Adidas Ultraboost 21
            [
                'url' => 'sneaker-nu-chunky.jpg',
                'image_able_id' => 2,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sneaker-nu-chunky-1.jpg',
                'image_able_id' => 2,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sneaker-nu-chunky-2.jpg',
                'image_able_id' => 2,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sneaker-nu-chunky-3.jpg',
                'image_able_id' => 2,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Sản phẩm 3: Adidas Ultraboost 21
            [
                'url' => 'sanpham3_1.jpg',
                'image_able_id' => 3,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham3_2.jpg',
                'image_able_id' => 3,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham3_3.jpg',
                'image_able_id' => 3,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham3_4.jpg',
                'image_able_id' => 3,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Sản phẩm 4: Adidas Ultraboost 21
            [
                'url' => 'sanpham4_1.jpg',
                'image_able_id' => 4,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham4_2.jpg',
                'image_able_id' => 4,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham4_3.jpg',
                'image_able_id' => 4,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham4_4.jpg',
                'image_able_id' => 4,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Sản phẩm 5: Adidas Ultraboost 21
            [
                'url' => 'sanpham5_1.jpg',
                'image_able_id' => 5,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham5_2.jpg',
                'image_able_id' => 5,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham5_3.jpg',
                'image_able_id' => 5,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'url' => 'sanpham5_4.jpg',
                'image_able_id' => 5,
                'image_able_type' => 'App\Models\Product',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('images')->insert($images);
    }
}
