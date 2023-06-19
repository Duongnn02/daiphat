<?php

namespace App\Http\Controllers;

use App\Models\InforPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InforPayController extends Controller
{
    public function index()
    {
        $inforPays = InforPay::latest()->get();
        return view('content.infor-pay.index', compact('inforPays'));
    }

    public function create()
    {
        return view('content.infor-pay.add');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'bank' => 'required',
            'bank_number' => 'required',
            'account_bank' => 'required',
            'content' => 'required',
            'notification' => 'nullable',
        ]);

        InforPay::create($input);

        return redirect()->route('infor-pay.index')->with('message', 'Thêm thành công');
    }

    public function destroy($id)
    {
        try {
            $inforPay = InforPay::destroy($id);
            return response()->json($inforPay);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json($inforPay);
        }
    }

    public function changeStatus($id)
    {
        $inforPay = InforPay::findOrFail($id);

        $status = match ($inforPay->status) {
            0 => 1,
            1 => 0,
            default => 0
        };

        $inforPay->update([
            'status' => $status
        ]);
        return back()->with('message', 'cập nhật thành công');
    }

    public function getInforPay()
    {
        $inforPay = InforPay::latest()->first();

        if (empty($inforPay)) {
            return response()->json(['message', 'not found'], 200);
        }

        return response()->json(['inforPay' => $inforPay, 'message' => 'success']);
    }}
