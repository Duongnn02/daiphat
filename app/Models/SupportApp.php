<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportApp extends Model
{
    use HasFactory;
    protected $fillable = ['app', 'status', 'link'];

}
