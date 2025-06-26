<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductDetailController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// comment
Route::post('/sendcomment/{product_code}/{user_code}', [CommentController::class, 'sendComment']);

//get Detail Product By Id

Route::get('/getDetailProduct/{id}', [ProductDetailController::class, 'getProductById']);

//get comment by Id
Route::get('/getRelatedProduct/{category_id}', [ProductDetailController::class, 'getRelatedProduct']);
Route::get('/getCommentByIdProduct/{product_id}', [CommentController::class, 'getCommentByIdProduct']);