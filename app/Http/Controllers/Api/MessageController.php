<?php

namespace App\Http\Controllers\Api;

use App\Enums\CodeStatusEnum;
use App\Events\NewChatMessage;
use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $admin = 1;
        $users = '';
        if (Auth::user()->role_id == $admin) {
            $messages = Message::with([
                'user' => function ($query) {
                    $query->select('id', 'name', 'phone');
                }])->get();
            $users = User::withCount('messages')
                ->where('id', '!=', User::IS_ADMIN)
                ->having('messages_count', '>', 0)
                ->get();
        } else {
            $userId = Auth::user()->id;
            $messages = Message::where('from_user', $userId)->with(['user' => function ($query) {
                $query->select('id', 'name');
            }])->get();
        }

        return response()->json(['messages' => $messages, 'users' => $users], 200);
    }

    public function store($userId, Request $request)
    {
        $message = new Message();
        $message->from_user = Auth::id();
        $message->to_user = Auth::user()->id != User::IS_ADMIN ? User::IS_ADMIN : $userId;
        $message->message = $request->get('message');
        $message->save();

        broadcast(new SendMessage($message))->toOthers();

        return response()->json(
            [
                'message' => $message,
                'status' => CodeStatusEnum::SUCCESS
            ], 201
        );
    }

    public function show($userId)
    {
        if (empty($userId)) {
            return response()->json(CodeStatusEnum::ERROR, 400);
        }
        $message = Message::where('from_user', $userId)
                ->orWhere(function ($query) use ($userId) {
                    $query->where('from_user', User::IS_ADMIN)->where('to_user', $userId);
                })->get();
        $user = User::select('id', 'name', 'phone')->where('id', $userId)->first();
        return response()->json(['message' => $message, 'user' => $user], 200);

    }
}
