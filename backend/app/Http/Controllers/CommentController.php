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
        ->where('comments.parent_id', null)
        ->select('comments.*', 'users.name_user')
        ->get();
        return response()->json($dataCommentById);
    }

    public function sendReply(Request $request)
    {
        $validated = $request->validate(
            [
                'user_id' => 'required|integer',
                'comment_content' => 'required|string',
                'product_id' => 'required|exists:products,id',
                'parent_id' => 'nullable|exists:comments,id',
            ]
        );

        $comment = Comment::create([
            'user_id' => $validated['user_id'],
            // 'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'parent_id' => $validated['parent_id'],
            'comment_content' => $validated['comment_content'],
        ]);
        return response()->json([
            'message' => 'Gửi trả lời bình luận thành công',
            'replyComment' => $comment
        ]);
    }

    public function getRepliesByProduct() {
        $replies = Comment::from('comments as c')
        ->join('users as u', 'c.user_id', '=', 'u.id') // người viết bình luận hiện tại
        ->leftJoin('comments as c_parent', 'c.parent_id', '=', 'c_parent.id') // comment gốc
        ->leftJoin('users as u_parent', 'c_parent.user_id', '=', 'u_parent.id') // người viết comment gốc
        ->whereNotNull('c.parent_id')
        ->select(
            'c.*',
            'u.name_user as current_user_name',
            'u_parent.name_user as parent_user_name'
        )
        ->orderBy('c.created_at', 'asc')
        ->get();

        return response()->json($replies);
    }

}
