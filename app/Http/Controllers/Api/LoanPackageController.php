<?php

namespace App\Http\Controllers;

use App\Models\LoanPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanPackageController extends Controller
{
    public function store(Request $request)
    {
        $input = [
            'user_id',
            'total_loan',
            'time',
            'status',
            'recurring_payment'
        ];
        $data = $request->only($input);
        $data['user_id'] = Auth::user()->id;
        $loans = LoanPackage::create($data);
        return response()->json(['loans' => $loans, 'message' => 'vay thanh cong'], 200);
    }
}
