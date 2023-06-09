<?php

namespace App\Http\Controllers\Api;

use App\Enums\CodeStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Logo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class AuthController extends Controller
{
    use UploadFileTrait;

    public function register(RegisterRequest $request)
    {
        $input = $request->only('phone', 'password');
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'status_code' => 200,
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['phone', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);

        } else {
            return response()->json(['error' => 'Số điện thoại hoặc mật khẩu chưa đúng'], 400);
        }
    }

    public function uploadCmnd(Request $request, $id)
    {
        ini_set('memory_limit', '64M');

        $validated = $request->validate([
            'name' => 'required',
            'cccd_cmnd' => 'required',
            'permanent_address' => 'required',
            'day_of_birthday' => 'required',
            'before_cccd_cmnd' => [
                'required'
            ],
            'after_cccd_cmnd' => [
                'required'
            ],
            'face_cccd_cmnd' => [
                'required'
            ],
        ]);
        $user = User::findOrFail($id);

        if ($request->hasFile('before_cccd_cmnd')) {
            $user->before_cccd_cmnd = $this->uploadFile($request->before_cccd_cmnd, 'cccd');
        }
        if ($request->hasFile('after_cccd_cmnd')) {
            $user->after_cccd_cmnd = $this->uploadFile($request->after_cccd_cmnd, 'cccd');
        }
        if ($request->hasFile('face_cccd_cmnd')) {
            $user->face_cccd_cmnd = $this->uploadFile($request->face_cccd_cmnd, 'cccd');
        }
        $data = [
            'name' => $request->name,
            'cccd_cmnd' => $request->cccd_cmnd,
            'day_of_birthday' => $request->day_of_birthday,
            'permanent_address' => $request->permanent_address,
            'before_cccd_cmnd' => $user->before_cccd_cmnd,
            'after_cccd_cmnd' => $user->after_cccd_cmnd,
            'face_cccd_cmnd' => $user->face_cccd_cmnd
        ];
        try {
        if ($user->update($data)) {
            $user->update([
                'status_cmnd' => 1
            ]);
        }
        return response()->json(['data' => $user, 'message' => 'Hoàn thành'], 200);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
        ]);

        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json(['user' => $user, 'message' => 'Thay đổi thành công vui lòng đăng nhập lại']);
        } else {
            return response()->json(['message' => 'mật khẩu không chính xác']);
        }
    }

    public function getLogo()
    {
        $logo = Logo::where('status', 1)->latest()->first();
        if (empty($logo)) {
            return response()->json(['message', 'not found'],  400);
        }

        return response()->json(['logo' => $logo, 'message' => 'success'], 200);
    }
}
