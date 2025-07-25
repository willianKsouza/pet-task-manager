<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;


Broadcast::channel('tasks.channel.{user_id}', function ($user, $user_id) {
    if ($user->role === 'admin') {
        return true;
    }
    return (int) $user->id === (int) $user_id;
});
