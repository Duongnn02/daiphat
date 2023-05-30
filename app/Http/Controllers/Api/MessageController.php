<?php

namespace App\Http\Controllers\Api;

use App\Enums\CodeStatusEnum;
use App\Events\NewChatMessage;
use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $isAdmin = User::IS_ADMIN;
        if ($user->role_id == $isAdmin) {
            $users = User::whereHas('messages', function ($query) use ($isAdmin) {
                $query->where('to_user', $isAdmin)
                    ->orWhere('from_user', $isAdmin);
            })
                ->where('role_id', User::IS_USER)
                ->get();
            return response()->json(['users' => $users], 200);
        }
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->from_user = Auth::user()->role_id == User::IS_USER ? Auth::id() : User::IS_ADMIN;
        $message->to_user = $request->to_user;
        $message->message = $request->get('message');
        $message->save();

        broadcast(new SendMessage($message))->toOthers();

        return response()->json(
            [
                'message' => $message,
                'status' => CodeStatusEnum::SUCCESS
            ],
            201
        );
    }

    public function show($userId): JsonResponse
    {
        if (empty($userId)) {
            return response()->json(CodeStatusEnum::ERROR, 400);
        }
        if (Auth::user()->role_id == User::IS_ADMIN) {
            $message = Message::where(function ($query) use ($userId) {
                $query->where('from_user', $userId)
                    ->orWhere('to_user', $userId);
            })
                ->orWhere(function ($query) use ($userId) {
                    $query->where('to_user', $userId)
                        ->whereIn('from_user', function ($subquery) {
                            $subquery->select('id')
                                ->from('users')
                                ->where('role_id', User::IS_ADMIN);
                        });
                })
                ->get();
        } else {
            $message = Message::where('from_user', $userId)
                ->orWhere(function ($query) use ($userId) {
                    $query->where('to_user', $userId)
                        ->where('from_user', User::IS_ADMIN);
                })
                ->get();
        }

        $user = User::select('id', 'name', 'phone')->where('id', $userId)->first();
        return response()->json(['message' => $message, 'user' => $user], 200);
    }
}
