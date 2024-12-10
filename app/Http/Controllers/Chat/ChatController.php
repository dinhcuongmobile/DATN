<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function __construct() {

    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|integer',
            'message' => 'required|string|max:500',
        ]);

        // Xác định vai trò người gửi
        $senderRole = auth()->user()->vai_tro_id == 1 ? 'admin' : (auth()->user()->vai_tro_id == 2 ? 'staff' : 'customer');

        // Tạo tin nhắn
        $message = Message::create([
            'user_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'sender_role' => $senderRole,
        ]);

        // Phát tin nhắn
        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!', 'data' => $message]);
    }
}
