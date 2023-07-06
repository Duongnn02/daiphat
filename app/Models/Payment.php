<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'loan_id', 'status', 'note', 'proof'];

    public function loan()
    {
        return $this->belongsTo(LoanPackage::class, 'loan_id', 'id');
    }
}
