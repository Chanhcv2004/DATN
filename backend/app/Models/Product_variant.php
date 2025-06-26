<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    protected $fillable = ['product_id', 'color', 'size', 'stock_quantity', 'image_color_var'];
}
