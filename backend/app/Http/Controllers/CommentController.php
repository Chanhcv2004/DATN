<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;

class CommentController extends Controller
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

    public function sendComment($product_code, $user_code, Request $request)
    {
        $validated = $request->validate([
            "comment_content" => "required|string|max:255"
        ], ['comment_content.required' => 'Không có nội dung']);

        // Nếu product_code & user_code là ID:
        $comment = Comment::create([
            'user_id' => $user_code,
            'product_id' => $product_code,
            'status' => 'Hiện thị',
            'comment_content' => $validated['comment_content'],
        ]);

        return response()->json('Đã gửi');
    }

    public function getCommentByIdProduct($product_id) {
        $dataCommentById = Comment::join('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.product_id', $product_id)
        ->select('comments.*', 'users.name_user')
        ->get();
        return response()->json($dataCommentById);
    }

}
