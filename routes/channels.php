<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('notification-channel', function ($user) {
    return Auth::check();
});
