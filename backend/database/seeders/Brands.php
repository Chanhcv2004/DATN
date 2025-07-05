<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Brands extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'brand_name' => 'Giày Nữ Basic',
                'brand_logo' => 'brand-basic.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand_name' => 'Giày Sneaker',
                'brand_logo' => 'sneaker.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand_name' => 'Giày Thể Thao',
                'brand_logo' => 'sport.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
}
