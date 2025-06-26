<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Product_variant;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProductById($product_id)
    {
        $dataProductById = Product::with(['variants', 'images'])->find($product_id);

        return response()->json($dataProductById);
    }
    public function getRelatedProduct($category_id)
    {
        $dataRelatedProduct = Product::with(['images', 'category:id,category_name'])
            ->where('category_id', $category_id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return response()->json($dataRelatedProduct);
    }

}
