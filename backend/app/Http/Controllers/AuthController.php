<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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

    // Register
     public function register(Request $request)
     {
        // Kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name_user'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name_user.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email'    => 'Email không đúng định dạng.',
            'email.unique'   => 'Email đã tồn tại. Vui lòng dùng email khác.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min'       => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed'=> 'Mật khẩu xác nhận không khớp.',
        ]);


        // Nếu dữ liệu không hợp lệ
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Đăng ký thất bại',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Tạo người dùng mới
        $user = User::create([
            'name_user' => $request->name_user,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Đăng ký thành công',
            'user'    => $user,
        ], 201);
     }
     public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email hoặc mật khẩu không đúng.'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công!',
            'user' => $user
        ]);
    }
}
