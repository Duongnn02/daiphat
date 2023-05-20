<?php

namespace App\Http\Controllers\Api;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $admin =  1;
        if (Auth::user()->role_id == $admin) {
           $messages = Message::where('status', 0)->with(['user' => function($query)  {
                $query->select('id', 'name');
           }])->get();
        }else {
            $userId = Auth::user()->id;
            $messages = Message::where('user_id', $userId)->with(['user' => function($query)  {
                $query->select('id', 'name');
           }])->get();
        }

        return response()->json($messages, 200);
    }

    public function store(Request $request)
    {
        $input = [
            'message',
            'from_user',
            'to_user'
        ];

        $data = $request->only($input);
        $data['from_user'] = Auth::id();
        $data['to_user'] = 1;
        $message = Message::create($data);

        $getMessage = event(new SendMessage($message));
        dd($getMessage);
        return response()->json($getMessage, 201);
    }
}
