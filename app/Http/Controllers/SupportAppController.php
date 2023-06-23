<?php

namespace App\Http\Controllers;

use App\Models\SupportApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupportAppController extends Controller
{
    public function index()
    {
        $apps = SupportApp::latest()->get();
        return view('content.support.index', compact('apps'));
    }

    public function create()
    {
        return view('content.support.add');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'app' => 'required',
            'link' => 'required',
        ]);
        try {
            SupportApp::create($input);
            return redirect()->route('app.index')->with('message', 'Thêm thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('message', 'Thêm thất bại');
        }
    }

    public function destroy($id)
    {
        try {
            $app = SupportApp::destroy($id);
            return response()->json($app);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json($app);
        }
    }

    public function changeStatus($id)
    {
        $app = SupportApp::findOrFail($id);

        $status = match ($app->status) {
            0 => 1,
            1 => 0,
            default => 0
        };

        $app->update([
            'status' => $status
        ]);
        return back()->with('message', 'cập nhật thành công');
    }

    public function getAppSupport()
    {
        $app = SupportApp::where('status', 1)->latest()->first();

        if (empty($app)) {
            return response()->json(['message', 'not found'], 400);
        }

        return response()->json(['app' => $app, 'message' => 'success'], 200);
    }
}
