<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Product_variant;

class Product extends Model
{
    public $fillable = ['product_name', 'price_original', 'sale_price', 'status', 'category_id', 'brand_id'];
    public function images()
    {
        return $this->morphMany(Image::class, 'image_able');
    }
    public function variants() {
        return $this->hasMany(Product_variant::class, 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
