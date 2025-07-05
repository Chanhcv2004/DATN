<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function getAllBrands() {
        $dataBrands = Brand::all();
        return response()->json($dataBrands);
    }
}
