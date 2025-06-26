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
        ];

        DB::table('images')->insert($images);
    }
}
