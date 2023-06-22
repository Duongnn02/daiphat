<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoanPackage;
use App\Models\Payment;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    use UploadFileTrait;

    public function store(Request $request)
    {
        $input = [
            'user_id',
            'loan_id',
            'proof',
            'note'
        ];
        $loan = LoanPackage::where('user_id', Auth::id())->first();
        $data = $request->only($input);
        $data['user_id'] = Auth::id();
        $data['loan_id'] = $loan->id;

        if ($request->hasFile('proof')) {
            $data['proof'] = $this->uploadFile($request->proof, 'bang_chung');
        }

        try {
            Payment::create($data);
            return response()->json(['message', 'Thêm thành công'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message', 'Thêm thất bại'], 400);
        }
    }

    public function getPayment()
    {
        $userId = Auth::user()->id;
        $payments = Payment::where('user_id', $userId)
            ->whereIn('status', [LoanPackage::APPROVALED, LoanPackage::REJECT])
            ->with(['loan'])
            ->get();
        if (empty($payments)) {
            return response()->json(['message' => 'Not found'], 400);
        }

        return response()->json(['payments' => $payments, 'message' => 'thành công'], 200);
    }
}
