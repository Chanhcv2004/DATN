<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['product_name', 'price_original', 'sale_price', 'status', 'category_id', 'brand_id'];
}
