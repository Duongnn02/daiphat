<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforPay extends Model
{
    use HasFactory;
    protected $fillable = ['bank_number', 'account_bank', 'content', 'notification', 'bank'];

}
