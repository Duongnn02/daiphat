<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogoController extends Controller
{
    use UploadFileTrait;

    public function index()
    {
        $logos = Logo::latest()->get();
        return view('content.logo.index', compact('logos'));
    }

    public function create()
    {
        return view('content.logo.add');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'logo' => 'required',
            'description' => 'max:100',
        ]);
        if ($request->hasFile('logo')) {
            $input['logo'] = $this->uploadFile($request->logo, 'logo');
        }

        Logo::create($input);
        try {
            return redirect()->route('logo.index')->with('message', 'Thêm thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('message', 'Thêm thất bại');
        }
    }

    public function destroy($id)
    {
        try {
            $logo = Logo::destroy($id);
            return response()->json($logo);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json($logo);
        }
    }

    public function changeStatus($id)
    {
        $loan = Logo::findOrFail($id);

        $status = match ($loan->status) {
            0 => 1,
            1 => 0,
            default => 0
        };

        $loan->update([
            'status' => $status
        ]);
        return back()->with('message', 'cập nhật thành công');
    }

    
}
