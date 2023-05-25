<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoanPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = LoanPackage::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->get();


        return view('content.loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approval($id)
    {
        $loan = LoanPackage::findOrFail($id);

        $status = match ($loan->status) {
            0 => 2,
            1 => 2,
            2 => 2
        };

        $loan->update([
            'status' => $status
        ]);
        return back();
    }
    public function reject($id)
    {
        $loan = LoanPackage::findOrFail($id);

        $status = match ($loan->status) {
            0 => 1,
            2 => 1,
            1 => 1
        };

        $loan->update([
            'status' => $status
        ]);
        return back();
    }

    public function getMoneyLoan($userId)
    {
        $loans = LoanPackage::where('status', LoanPackage::APPROVALED)
            ->where('user_id', $userId)
            ->get();

            $sum = 0;
            foreach ($loans as $loan) {
                $sum += $loan->total_loan;
            }
        return response()->json(['loan' => $loans, 'sum' => $sum], 200);
    }
}
