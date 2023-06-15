<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['from_user', 'to_user', 'message', 'status', 'photo', 'viewed'];
    protected $table ='messages';
    protected $touches = ['toUser'];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user', 'id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user', 'id');
    }

}
