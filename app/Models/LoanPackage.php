<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPackage extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total_loan', 'time', 'status', 'recurring_payment', 'contract_number', 'viewed', 'type'];
    protected $table = 'loan_package';
    const APPROVAL = 2;
    const REJECT = 1;
    const PENDING = 0;
    const WATTING = 3;
    const VIEWED = 1;


    const APPROVALED = 2;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function  getInput($model)
    {
        return $model->fillable;
    }
}
