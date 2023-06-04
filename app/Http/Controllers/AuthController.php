<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewChangePassword()
    {
        return view('content.user.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        $user = Auth::user();
            if (Hash::check($request->current_password, $user->password)) {
                User::whereId(auth()->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                $data = ['user' => $user, 'message' => 'Thay đổi thành công vui lòng đăng nhập lại'];

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('/login');
            } else {
                $data = ['message' => 'mật khẩu không chính xác', 'alert' => 'error'];

                return back()->with(['data' => $data]);
            }
    }
}
