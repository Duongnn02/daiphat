<?php

namespace App\Http\Controllers\Api;

use App\Enums\CodeStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadFileTrait;

class AuthController extends Controller
{
    use UploadFileTrait;

    public function register(RegisterRequest $request)
    {
        $input = $request->only('phone', 'password');
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $token = $user->createToken('Token Name')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $credentials = request(['phone', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult =  $user->createToken('Myapp');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            return response()->json([
                'user' => $user,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 400);
        }
    }

    public function uploadCmnd(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'cccd_cmnd' => 'required',
        //     'before_cccd_cmnd' => 'required',
        //     'after_cccd_cmnd' => 'required',
        //     'face_cccd_cmnd' => 'required',
        // ]);
        $user = User::findOrFail($id);

        // $user->name = $request->name;
        // $user->cccd_cmnd = $request->cccd_cmnd;

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
}
