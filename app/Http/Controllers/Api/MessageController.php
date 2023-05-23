<?php

namespace App\Http\Controllers\Api;

use App\Enums\CodeStatusEnum;
use App\Events\NewChatMessage;
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
            $messages = Message::where('status', 0)->with(['user' => function ($query) {
                $query->select('id', 'name');
            }])->get();
        } else {
            $userId = Auth::user()->id;
            $messages = Message::where('from_user', $userId)->with(['user' => function ($query) {
                $query->select('id', 'name');
            }])->get();
        }

        return response()->json($messages, 200);
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->from_user = Auth::id();
        $message->to_user = Message::TO_ADMIN;
        $message->message = $request->get('message');
        $message->save();

        broadcast(new SendMessage($message))->toOthers();

        return response()->json(
            [
                'message' => $message,
                'status' => CodeStatusEnum::SUCCESS
            ],201
        );
    }
}
