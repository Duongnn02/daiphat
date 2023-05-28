<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoanPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\TestSuite\Loaded;

class LoanPackageController extends Controller
{
    private $model;
    private $listRoute;

    public function __construct()
    {
        $this->model = new LoanPackage();
        $this->listRoute = redirect()->route('loan.index');
    }

    public function index()
    {
        $loans = LoanPackage::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->latest()->paginate(10);


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
            'recurring_payment',
            'contract_number'
        ];
        $data = $request->only($input);
        $data['user_id'] = Auth::user()->id;
        $data['contract_number'] = rand(1111111111,9999999999);
        $loans = LoanPackage::create($data);
        return response()->json(['loans' => $loans, 'message' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $loan = $this->model->findOrFail($id);
        return response()->json(['loan' => $loan, 'message' => 'success'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $loan = LoanPackage::findOrFail($id);
        return view('content.loan.edit',compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $loan = $this->model->findOrFail($id);
        $input = LoanPackage::getInput($this->model);
        try {
            $loan->update($request->only($input));
            return $this->listRoute->with('message', 'Sửa thành công');
        } catch (\Exception $e) {
            return $this->listRoute->with('message', 'Sửa thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $loan = $this->model->destroy($id);
            return response()->json($loan);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json($loan);
        }
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
        return back()->with('message', 'cập nhật thành công');
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
        return back()->with('message', 'cập nhật thành công');
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
        return response()->json(['loans' => $loans, 'sum' => $sum], 200);
    }
}
