<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Xác định vai trò người gửi
        $user = User::find($request->user_id);

        if($user->vai_tro_id==1) $senderRole = 'quanTriVien';
        elseif($user->vai_tro_id==2) $senderRole = 'nhanVien';
        else $senderRole = 'thanhVien';

        // Tạo tin nhắn
        $message = Message::create([
            'user_id' => $request->user_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'sender_role' => $senderRole,
        ]);

        // Phát tin nhắn
        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!', 'data' => $message]);
    }
}
