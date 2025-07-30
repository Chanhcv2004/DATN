<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;

class PersonalController extends Controller
{
   public function getPersonal($id)
    {
        $dataPersonal = User::select('name_user', 'email', 'phone', 'address')
                            ->where('id', $id)
                            ->first();

        if (!$dataPersonal) {
            return response()->json([
                'Personal' => null,
                'errors' => 'Không tìm thấy thông tin'
            ]);
        }

        return response()->json([
            'Personal' => $dataPersonal,
            'errors' => null
        ]);
    }

    public function updatePersonal(Request $request)
    {
        $validated = $request->validate(
            [
                "id" => "required|integer",
                "name" => "required|string|max:255",
                "phone" => ["required", "regex:/^0[0-9]{9}$/"],
                "address" => "required|string|max:111"
            ],
            [
                "name.required" => "Không thể để trống họ và tên",
                "phone.required" => "Không thể để trống số điện thoại",
                "phone.regex" => "Số điện thoại phải bắt đầu từ số 0 và gồm 10 số.",
                "address.required" => "Không thể để trống địa chỉ",
            ]
        );

        // Nếu dữ liệu không hợp lệ, Laravel sẽ tự động trả về lỗi 422, không chạy tiếp

        $user = User::find($validated['id']);
        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy người dùng',
            ], 404);
        }

        $user->name_user = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thông tin thành công',
            'data' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'currentPassword' => 'required|string|max:15',
            'newPassword' => 'required|string|confirmed|max:15',
        ],
        [
            'currentPassword.required' => 'Không để trống mật khẩu hiện tại',
            'newPassword.required' => 'Khống để trống mật khẩu mới',
            'newPassword.confirmed' => 'Mật khẩu không trùng khớp' 
        ]);
        $user = User::find($validated['id']);
        if(!$user) {
            return response()->json([
                'message' => 'Không tìm thấy người dùng',
            ], 404);
        }

        if(!hash::check($validated['currentPassword'], $user->password)) {
            return response()->json(['message' => 'Mật khẩu hiện tại không đúng'], 404);
        }
        $user->password =  Hash::make($validated['newPassword']);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thông tin thành công',
            'data' => $user
        ]);
    }
}
