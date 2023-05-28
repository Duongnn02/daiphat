<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPackage extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total_loan', 'time', 'status', 'recurring_payment', 'contract_number'];
    protected $table ='loan_package';

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
