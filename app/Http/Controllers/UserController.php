<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $model;
    private $listRoute;

    public function __construct()
    {
        $this->model = new User();
        $this->listRoute = redirect()->route('user.index');
    }

    public function index()
    {
        $users = User::latest()->paginate(10);
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
        return view('content.user.edit', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->model->findOrFail($id);
        return view('content.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->model->findOrFail($id);
        $input = User::getInput($this->model);
        try {
            $user->update($request->only($input));
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
