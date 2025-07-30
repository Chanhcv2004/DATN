<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PersonalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'autoResetPassword']);

// comment
Route::post('/sendcomment/{product_code}/{user_code}', [CommentController::class, 'sendComment']);

//get Detail Product By Id

Route::get('/getDetailProduct/{id}', [ProductDetailController::class, 'getProductById']);

//get comment by Id
Route::get('/getRelatedProduct/{category_id}', [ProductDetailController::class, 'getRelatedProduct']);
Route::get('/getCommentByIdProduct/{product_id}', [CommentController::class, 'getCommentByIdProduct']);

Route::get('/getAllOrSearchPro', [ProductController::class, 'getAllOrSearchPro']);
Route::get('/getAllCategories', [CategoryController::class, 'getAllCategories']);
Route::get('/getAllBrands', [BrandController::class, 'getAllBrands']);

Route::get('/getPersonal/{id_user}', [PersonalController::class, 'getPersonal']);

Route::post('/updatePersonal', [PersonalController::class, 'updatePersonal']);

Route::post('changePassword', [PersonalController::class, 'changePassword']);

route::post('/sendReply', [CommentController::class, 'sendReply']);

Route::get('/getRepliesByProduct', [CommentController::class, 'getRepliesByProduct']);

Route::get('/test-mail', function () {
    Mail::raw('Đây là email test từ Laravel', function ($message) {
        $message->to('chanhdz0342@gmail.com');
        $message->subject('Mail test');
    });

    return 'Đã gửi mail';
});