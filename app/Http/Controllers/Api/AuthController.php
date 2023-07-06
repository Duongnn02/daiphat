<?php

namespace App\Http\Controllers\Api;

use App\Enums\CodeStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgetPassword;
use App\Models\Logo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
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
        $validated = $request->validate([
            'name' => 'required',
            'cccd_cmnd' => 'required',
            'permanent_address' => 'required',
            'day_of_birthday' => 'required',
            'before_cccd_cmnd' => [
                'required', 'mimes:jpeg,jpg,png,gif|required'
            ],
            'after_cccd_cmnd' => [
                'required', 'mimes:jpeg,jpg,png,gif|required'
            ],
            'face_cccd_cmnd' => [
                'required', 'mimes:jpeg,jpg,png,gif|required'
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
        if ($user->update($data)) {
            $user->update([
                'status_cmnd' => 1
            ]);
        }
        return response()->json(['data' => $user, 'message' => 'Hoàn thành'], 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'mật khẩu không chính xác'], 400);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['message' => 'Thay đổi thành công vui lòng đăng nhập lại'], 200);

    }

    public function getLogo()
    {
        $logo = Logo::where('status', 1)->latest()->first();
        if (empty($logo)) {
            return response()->json(['message', 'not found'], 400);
        }

        return response()->json(['logo' => $logo, 'message' => 'success'], 200);
    }

    public function forgetPassword(Request $request): JsonResponse
    {
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Vui lòng điền email',
            'email.email' => 'Email không đúng định dạng',
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $checkEmailExists = User::where('email', $email)->exists();

        if (!$checkEmailExists) {
            return new JsonResponse(['success' => false, 'message' => 'Email không tồn tại'], 422);
        }

        $newPassword = 12345678;
        $user = User::where('email', $email)->first();

        $user->update([
            'password' => bcrypt($newPassword)
        ]);

        try {
            Mail::to($email)->send(new ForgetPassword($user, $newPassword));
            return new JsonResponse(
                [
                    'message' => 'Đổi mật khẩu thành công, vui lòng kiểm tra email',
                    'success' => true,
                ],
                200
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return new JsonResponse(
                [
                    'message' => 'Đổi mật khẩu thất bại',
                    'success' => false,
                ],
                400
            );
        }
    }
}
