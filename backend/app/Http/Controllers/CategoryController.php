<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $dataCategories = Category::all();
        return response()->json($dataCategories);
    }
}
