<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use UploadFileTrait;

    private $model;
    private $listRoute;

    public function __construct()
    {
        $this->model = new User();
        $this->listRoute = redirect()->route('user.index');
    }

    public function index(Request $request)
    {
        $search = $request->get('key_word');
        $perPage = 15;

        $users = User::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%');
        })
            ->latest()
            ->paginate($perPage);
        return view('content.user.index', compact('users'));
    }

    public function create()
    {
        return view('content.user.add');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return back()->with('message', 'Thêm thành công');
    }

    public function show($id)
    {
        $user = $this->model->findOrFail($id);
        $relationships = User::RELATIONSHIP;

        foreach ($relationships as $relationship) {
            if (in_array($user->relationship_family, array_flip($relationships))) {
                $user->relationship_family = $relationship;
            }
            if (in_array($user->relationship_other, array_flip($relationships))) {
                $user->relationship_other = $relationship;
            }
        }
        return view('content.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->model->findOrFail($id);
        $relationships = User::RELATIONSHIP;
        return view('content.user.edit', compact('user', 'relationships'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->model->findOrFail($id);
        $input = User::getInput($this->model);
        $data = $request->only($input);
        if ($request->hasFile('before_cccd_cmnd')) {
            $data['before_cccd_cmnd'] = $this->uploadFile($request->before_cccd_cmnd, 'cccd');
        }
        if ($request->hasFile('after_cccd_cmnd')) {
            $data['after_cccd_cmnd'] = $this->uploadFile($request->after_cccd_cmnd, 'cccd');
        }
        if ($request->hasFile('face_cccd_cmnd')) {
            $data['face_cccd_cmnd'] = $this->uploadFile($request->face_cccd_cmnd, 'cccd');
        }
        if ($request->hasFile('additional_information')) {
            $data['additional_information'] = $this->uploadFile($request->additional_information, 'thong_tin_them');
        }
        if ($request->hasFile('signature')) {
            $data['signature'] = $this->uploadFile($request->signature, 'chu_ky');
        }
        try {
            $user->update($data);
            return $this->listRoute->with('message', 'Sửa thành công');
        } catch (Exception $e) {
            return $this->listRoute->with('message', 'Sửa thất bại');
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->model->destroy($id);
            return response()->json($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json($user);
        }
    }

}
