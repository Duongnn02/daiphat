<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['from_user', 'to_user', 'message', 'status'];
    protected $table ='messages';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}