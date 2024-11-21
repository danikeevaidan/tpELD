<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('driver-notification-channel', function (User $user) {
    return true;
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return true;//(int) $user->id === (int) $id;
});

