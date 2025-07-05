<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Product_variant;

class ProductController extends Controller
{
    public function getAllOrSearchPro(Request $request) {
        $query = Product::query();

        if ($request->has('keyword') && !empty($request->keyword)) {
            $keyword = $request->keyword;
            $query->where('product_name', 'LIKE', '%' . $keyword . '%');
        }

        $products = $query->with(['images', 'category:id,category_name'])->get();

        return response()->json($products);
    }
}
