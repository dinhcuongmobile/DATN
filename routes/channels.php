<?php

use Illuminate\Support\Facades\Broadcast;

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
    return (int) $user->id === (int) $receiver_id || in_array($user->vai_tro_id, [1, 2]);
    // vai_tro_id: 1 - admin, 2 - nhân viên
});
