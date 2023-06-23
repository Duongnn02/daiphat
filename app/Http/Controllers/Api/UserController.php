<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use UploadFileTrait;
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user], 200);
    }

    public function storeInfor(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ], [
            'email.required' => 'Vui lòng điền email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }
        $input = User::getInput($this->model);
        $user = User::findOrFail($id);

        try {
            $data = $user->update($request->only($input));
            if ($data) {
                $user->update([
                    'status_infor' => 1
                ]);
            }
            return response()->json(['data' => $user, 'message' => 'Hoàn thành'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response('Thêm thất bại', 400);
        }
    }

    public function storeBank(Request $request, $id)
    {
        $validated = $request->validate([
            'account_name' => 'required|max:100',
            'bank' => 'required|max:100',
            'number_bank' => 'required|max:100',
        ]);

        $input = [
            'account_name',
            'bank',
            'number_bank',
            'status_bank',
        ];

        $user = User::findOrFail($id);

        try {
            $data = $user->update($request->only($input));
            if ($data) {
                $user->update([
                    'status_bank' => 1
                ]);
            }
            return response()->json(['data' => $user, 'message' => 'Hoàn thành'], 200);
        } catch (Exception $e) {
            return response('Thêm thất bại', 400);
        }
    }

    public function uploadAdditional(Request $request, $id)
    {
        $validated = $request->validate([
            'additional_information' => [
                'required', 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('additional_information')) {
            $user->additional_information = $this->uploadFile($request->additional_information, 'thong_tin_them');
        }
        $data = [
            'additional_information' => $user->additional_information
        ];
        if ($user->update($data)) {
            $user->update([
                'status_additional' => 1
            ]);
        }
        return response()->json(['data' => $user, 'message' => 'Hoàn thành'], 200);
    }

    public function uploadSignature(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $signature = $request->signature;
        $folder = 'chu_ky/';
        if ($signature) {
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $imageName = Str::random(10) . '.png';
            Storage::disk('local')->put('public/'.$folder.$imageName, base64_decode($signature));
        }
        $data = [
            'signature' => 'storage/' . $folder . $imageName
        ];
        if ($user->update($data)) {
            $user->update([
                'status_signature' => 1
            ]);
        }
        return response()->json(['data' => $user, 'message' => 'Hoàn thành'], 200);
    }
}
