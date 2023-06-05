<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
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
}
