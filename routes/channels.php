<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{receiver_id}', function ($user, $receiver_id) {
    // Kiểm tra guard admin
    if ($adminUser = Auth::guard('admin')->user()) {
        return (int) $adminUser->id === (int) $receiver_id || in_array($adminUser->vai_tro_id, [1, 2]);
    }

    // Kiểm tra guard mặc định (web)
    if ($webUser = Auth::guard('web')->user()) {
        return (int) $webUser->id === (int) $receiver_id;
    }
    // Không xác thực được
    return false;
});
