<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoanPackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PDF;

class LoanPackageController extends Controller
{
    private $model;
    private $listRoute;

    public function __construct()
    {
        $this->model = new LoanPackage();
        $this->listRoute = redirect()->route('loan.index');
    }

    public function index(Request $request)
    {
        $search = $request->get('key_word');
        $perPage = 15;

        $loans = LoanPackage::with('user')
            ->whereHas('user', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $search . '%');
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

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
            'contract_number',
        ];
        $userId = Auth::user()->id;
        $isPending = $this->model->where('user_id', $userId)
            ->where('status', LoanPackage::PENDING)
            ->exists();

        if ($isPending) {
            return response()->json(['message' => 'Bạn có khoản vay chưa được duyệt, vui lòng liên hệ bộ phận hỗ trợ'], 401);
        }

        $isLoanExists = $this->model->where('user_id', $userId)
            ->where('status', LoanPackage::APPROVALED)
            ->get();

        if (count($isLoanExists) > 0) {
            return response()->json(['message' => 'Bạn đang có khoản vay tồn tại, vui lòng liên hệ bộ phận hỗ trợ'], 401);
        }

        $data = $request->only($input);
        $data['user_id'] = $userId;
        $data['contract_number'] = rand(1111111111, 9999999999);
        $loans = LoanPackage::create($data);
        return response()->json(['loans' => $loans, 'message' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userId = Auth::user()->id;
        $loan = $this->model->where('user_id', $userId)->latest()->first();
        return response()->json(['loan' => $loan, 'message' => 'success'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $loan = LoanPackage::findOrFail($id);
        return view('content.loan.edit', compact('loan'));
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

    public function approvalWithdrawl($id)
    {
        $loan = LoanPackage::findOrFail($id);

        $type = match ($loan->type) {
            3 => 2,
            1 => 2,
            2 => 2
        };

        $loan->update([
            'type' => $type
        ]);
        return back()->with('message', 'cập nhật thành công');
    }

    public function rejectWithdrawl($id)
    {
        $loan = LoanPackage::findOrFail($id);

        $type = match ($loan->type) {
            3 => 1,
            2 => 1,
            1 => 1
        };

        $loan->update([
            'type' => $type
        ]);
        return back()->with('message', 'cập nhật thành công');
    }

    public function getMoneyLoan()
    {
        $user = Auth::user();
        $userId = $user->id;
        $loans = LoanPackage::where('user_id', $userId)
            ->where('status', LoanPackage::APPROVALED)
            ->get();

        $sum = 0;
        foreach ($loans as $loan) {
            $sum += $loan->total_loan;
            $date = Carbon::createFromFormat('d/m/Y', $loan->updated_at);
        }
        $user = User::where('id', $userId)->first();
        return response()->json(['loans' => $loans, 'sum' => $sum, 'user' => $user], 200);
    }

    public function approved()
    {
        $userId = Auth::user()->id;
        $loan = LoanPackage::where('user_id', $userId)
            ->where('status', LoanPackage::APPROVALED)
            ->where('viewed', '!=', LoanPackage::VIEWED)
            ->first();

        if (empty($loan)) {
            return response()->json(['message' => 'Not found'], 400);
        }

        $isApproval = $loan->exists();
        if ($isApproval) {
            $message = 'Khoản vay đã được duyệt';
            return response()->json(['message' => $message, 'loan' => $loan], 200);
        }
    }

    public function viewed()
    {
        $userId = Auth::user()->id;
        $loan = LoanPackage::where('user_id', $userId)
            ->where('status', LoanPackage::APPROVALED)
            ->where('viewed', '!=', LoanPackage::VIEWED)
            ->first();
        if (empty($loan)) {
            return response()->json(['message' => 'Not found'], 400);
        }

        $isApproval = $loan->exists();
        if ($isApproval) {
            $loan->update([
                'viewed' => LoanPackage::VIEWED
            ]);
            return response()->json(['message' => 'Đã xem', 'loan' => $loan], 200);
        }
    }

    public function handleWithdrawl($id)
    {
        $loan = $this->model->findOrFail($id);

        if (empty($loan)) {
            return response()->json(['message' => 'Not found'], 400);
        }

        switch ($loan->type) {
            case LoanPackage::PENDING:
                $loan->update([
                    'type' => LoanPackage::WATTING,
                ]);
                $message = 'Rút tiền thành công. Vui lòng liên hệ bộ phận hỗ trợ để được duyệt nhanh hơn';
                break;
            case LoanPackage::WATTING:
                $message = 'Khoản vay đang chờ xử lý. Vui lòng liên hệ bộ phận hỗ trợ để được duyệt nhanh hơn';
                break;
            case LoanPackage::REJECT:
                $message = 'Khoản vay đã bị từ chối. Quý khách vui lòng liên hệ CSKH để được hỗ trợ';
                break;
            case LoanPackage::APPROVAL:
                $message = 'Khoản vay đã được duyệt';
                break;

            default:
                break;
        }
        return response()->json(['message' => $message, 'loan' => $loan], 200);

    }

    public function readContract($id)
    {
        $loan = $this->model->findOrFail($id);
        if (empty($loan)) {
            return response()->json(['message' => 'Not found'], 400);
        }
        $signature = str_replace('storage/', '', $loan->user->signature);

        $data = [
            'title' => 'Hợp đồng tín dụng',
            'loan' => $loan,
            'signature' => $signature
        ];
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('content.loan.contract', $data);
        return $pdf->stream('contract.pdf');
    }

//    public function ApprovalWithdrawl($id)
//    {
//        $loan = $this->model->findOrFail($id);
//
//        if (empty($loan)) {
//            return response()->json(['message' => 'Not found'], 400);
//        }
//
//        $type = match ($loan->type) {
//            LoanPackage::PENDING =>  false,
//            LoanPackage::WATTING => LoanPackage::APPROVAL,
//        };
//
//        $loan->update([
//            'type' => LoanPackage::APPROVAL
//        ]);
//        return response()->json(['message' => 'Đang chờ xử lý', 'loan' => $loan], 200);
//    }
}
