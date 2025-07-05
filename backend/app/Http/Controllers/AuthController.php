<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
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

    public function autoResetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'Email không tồn tại trong hệ thống'], 404);
    }

    // Tạo mật khẩu mới
    $newPassword = Str::random(8); // vd: x8hY2p9z

    // Lưu vào DB
    $user->password = Hash::make($newPassword);
    $user->save();

    // Gửi mật khẩu mới qua email
    Mail::raw("Mật khẩu mới của bạn là: {$newPassword}", function ($message) use ($user) {
        $message->to($user->email);
        $message->subject('Mật khẩu mới');
    });

    return response()->json(['message' => 'Mật khẩu mới đã được gửi về email của bạn']);
}

}
